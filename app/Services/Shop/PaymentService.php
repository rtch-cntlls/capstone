<?php

namespace App\Services\Shop;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PaymentService
{
    protected $baseUrl = 'https://api.paymongo.com/v1';

    public function createGcashSource($orderId)
    {
        $order = Order::with('orderItems', 'address')->find($orderId);
        if (!$order) {
            throw new \Exception('Order not found.');
        }

        $user = Auth::user();
        $customerName = trim(($user->firstname ?? '') . ' ' . ($user->lastname ?? '')) ?: 'Customer';
        $amountInCentavos = (int)($order->grand_total * 100);

        $response = Http::withBasicAuth(config('services.paymongo.secret'), '')
            ->post($this->baseUrl . '/sources', [
                'data' => [
                    'attributes' => [
                        'type' => 'gcash',
                        'amount' => $amountInCentavos,
                        'currency' => 'PHP',
                        'redirect' => [
                            'success' => route('payment.success', ['order_id' => $orderId]),
                            'failed' => route('checkout.checkout'), 
                        ],
                        'billing' => [
                            'name' => $customerName,
                            'email' => $user->email ?? 'customer@example.com',
                        ],
                    ]
                ]
            ]);

        return $response->json();
    }

    public function createCheckoutSession($orderId, $paymentMethodType)
    {
        $order = Order::with('orderItems', 'address')->find($orderId);
        if (!$order) {
            throw new \Exception('Order not found.');
        }

        $user = Auth::user();
        $customerName = trim(($user->firstname ?? '') . ' ' . ($user->lastname ?? '')) ?: 'Customer';

        $lineItems = $order->orderItems->map(function ($item) {
            return [
                'currency'   => 'PHP',
                'amount'     => (int)($item->price * $item->quantity * 100),
                'name'       => $item->product_name,
                'quantity'   => $item->quantity,
            ];
        })->toArray();

        $response = Http::withBasicAuth(config('services.paymongo.secret'), '')
            ->post($this->baseUrl . '/checkout_sessions', [
                'data' => [
                    'attributes' => [
                        'billing' => [
                            'name'  => $customerName,
                            'email' => $user->email ?? 'customer@example.com',
                        ],
                        'send_email_receipt' => true,
                        'show_line_items'    => true,
                        'line_items'         => $lineItems,
                        'payment_method_types' => [$paymentMethodType],
                        'success_url' => route('payment.success', ['order_id' => $orderId]),
                        'cancel_url' => route('checkout.checkout'),
                    ]
                ]
            ]);
        return $response->json();
    }
}