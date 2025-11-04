<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Shop;
use App\Services\Shop\CheckoutService;
use App\Services\Payment\GeminiPaymentValidator;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected CheckoutService $CheckoutService;
    protected GeminiPaymentValidator $geminiValidator;

    public function __construct(CheckoutService $CheckoutService, GeminiPaymentValidator $geminiValidator)
    {
        $this->CheckoutService = $CheckoutService;
        $this->geminiValidator = $geminiValidator;
    }

    public function buyNow(Request $request)
    {
        $data = $request->validate([
            'product_id'   => 'required|exists:products,product_id',
            'product_name' => 'required|string',
            'image'        => 'nullable|string',
            'price'        => 'required|numeric|min:1',
            'quantity'     => 'required|integer|min:1',
            'discount'     => 'nullable|numeric|min:0',
        ]);

        $orderData = [
            'product_id'   => $data['product_id'],
            'product_name' => $data['product_name'],
            'image'        => $data['image'] ?? null,
            'price'        => $data['price'],
            'discount'     => $data['discount'] ?? 0,
            'quantity'     => $data['quantity'],
            'subtotal'     => $data['price'] * $data['quantity'],
            'delivery_fee' => $request->input('delivery_fee', 0),
        ];

        if (!Auth::check() || Auth::user()->role_id != 2) {
            session(['buy_now' => $orderData]);
            return redirect()->route('auth.customer.login');
        }

        $customer = $this->getCustomer();
        if (!$customer) {
            return back()->with('error', 'Customer profile not found.');
        }

        $orderData['customer_id'] = $customer->customer_id;
        session(['buy_now' => $orderData]);

        return redirect()->route('checkout.checkout');
    }

    public function checkout()
    {
        $order = session('buy_now') ?? session('cart_checkout');
        if (!$order) {
            return redirect()->route('shop.product')->with('error', 'No product selected for checkout.');
        }

        $customer = Auth::check() ? $this->getCustomer() : null;

        if ($customer) {
            if (isset($order['product_id'])) {
                $order = $this->attachCustomerId($order, $customer);
            } else {
                foreach ($order as &$item) {
                    $item['customer_id'] = $customer->customer_id;
                }
            }
            session(['cart_checkout' => $order]);
        }

        $shop = Shop::first();
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->user_id)->first();
        $address = $customer?->addresses()->latest()->first();


        $items = isset($order[0]) ? $order : [$order];
        $productIds = collect($items)->pluck('product_id')->filter()->all();
        $weights = \App\Models\Product::whereIn('product_id', $productIds)
            ->pluck('weight_kg', 'product_id');
        $totalWeightKg = 0.0;
        foreach ($items as $it) {
            $w = (float) ($weights[$it['product_id']] ?? 0);
            $qty = (int) ($it['quantity'] ?? 1);
            $totalWeightKg += $w * $qty;
        }

        return view('client.pages.checkout.index', compact('order', 'shop', 'address', 'totalWeightKg'));
    }

    public function cancelCheckout()
    {
        session()->forget(['buy_now', 'cart_checkout', 'checkout_order_id', 'checkout_payment_method']);
        return redirect()->route('shop.product')->with('info', 'Checkout canceled.');
    }

    public function placeOrder(Request $request)
    {
        $shop = Shop::first();
        $validationResult = $this->validateOrder($request, $shop);
        $order_type = $validationResult['order_type'];
        $orderSession = session('buy_now') ?? session('cart_checkout');

        $gcashReference = null;

        if ($request->payment_method === 'gcash' && $request->hasFile('payment_proof')) {
            $paymentProof = $request->file('payment_proof');
            $filename = 'gcash_' . time() . '.' . $paymentProof->getClientOriginalExtension();
            $paymentProof->move(public_path('payment'), $filename);

            $expectedAmount = $orderSession['subtotal'] ?? 0;
            if ($request->delivery_type === 'deliver') {
                $expectedAmount += floatval($request->delivery_fee ?? 0);
            }

            $result = $this->geminiValidator->validateScreenshot(
                public_path('payment/' . $filename),
                $expectedAmount
            );

            $validPayment = $result
                && isset($result['valid_format'], $result['amount'], $result['reference_number'])
                && $result['valid_format'] === true
                && \App\Services\Payment\GeminiPaymentValidator::isAmountValid(
                    $result['amount'],
                    $expectedAmount
                );

                if ($result && isset($result['transaction_date'])) {
                    $transactionDate = strtotime($result['transaction_date']);
                    $today = strtotime(date('Y-m-d'));
            
                    if ($result['too_old'] || $transactionDate === false) {
                        return redirect()->route('checkout.checkout')
                            ->with('error', 'Your GCash payment screenshot appears to be outdated. Please upload a recent payment proof.')
                            ->withInput();
                    }
                } else {
                    return redirect()->route('checkout.checkout')
                        ->with('error', 'Unable to detect the payment date from your GCash screenshot. Please ensure the date is clearly visible.')
                        ->withInput();
                }

                if (!$validPayment) {
                    Log::warning('Invalid GCash screenshot detected', [
                        'screenshot' => $filename,
                        'result' => $result,
                        'expected_amount' => $expectedAmount,
                    ]);
            
                    return redirect()->route('checkout.checkout')
                        ->with('error', 'Invalid GCash payment screenshot. Please upload the correct payment proof showing the exact amount.')
                        ->withInput();
                }

            $gcashReference = $result['reference_number'] ?? null;
            
            if ($gcashReference && \App\Models\Order::where('gcash_reference', $gcashReference)->exists()) {
                return redirect()->route('checkout.checkout')
                    ->with('error', 'This GCash reference number has already been used.')
                    ->withInput();
            }

            $request->merge(['payment_proof_filename' => $filename]);
        }

        try {
            $order = $this->CheckoutService->placeCheckout($request, $shop, $order_type);
        } catch (\Exception $e) {
            Log::error('CheckoutService error: ' . $e->getMessage());
            return redirect()->route('shop.product')->with('error', $e->getMessage());
        }

        if (!$order) {
            return redirect()->route('shop.product')->with('error', 'No product selected for checkout.');
        }

        if ($request->payment_method === 'gcash' && $request->has('payment_proof_filename')) {
            $order->payment_proof = 'payment/' . $request->payment_proof_filename;
            $order->payment_status = 'paid';
            $order->gcash_reference = $gcashReference;
            $order->save();
        } elseif ($request->has('pay_later') && $request->pay_later === 'on') {
            $order->payment_method = null;
            $order->payment_status = 'unpaid';
            $order->save();
        }

        session([
            'checkout_order_id' => $order->order_id,
            'checkout_payment_method' => $request->payment_method,
        ]);

        return redirect()->route('order.index')->with('success', 'Order placed successfully!');
    }

    protected function getCustomer()
    {
        return Customer::where('user_id', Auth::id())->first();
    }

    protected function attachCustomerId($order, $customer)
    {
        if ($order && !isset($order['customer_id'])) {
            $order['customer_id'] = $customer->customer_id;
        }
        return $order;
    }

    protected function validateOrder(Request $request, $shop)
    {
        $rules = [
            'delivery_type' => 'required|in:pick-up,deliver',
            'barangay'      => 'required|string',
            'street'        => 'required|string',
            'postal_code'   => 'required|numeric',
            'province'      => 'required|string',
            'city'          => 'required|string',
            'firstname'     => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => ['required', 'string', 'regex:/^09\d{9}$/'],
        ];

        if (!$request->has('pay_later') || $request->pay_later != 'on') {
            $rules['payment_method'] = 'required|in:gcash,maya,cod';
        }

        $order_type = $shop->service_area;

        if ($shop->service_area === 'local') {
            if (
                strtolower($request->province) !== strtolower($shop->province) ||
                strtolower($request->city) !== strtolower($shop->city)
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'address' => 'We are unable to deliver to this address. Please provide an address within the shop’s service area.',
                ]);
            }
        } elseif ($shop->service_area === 'province') {
            if (strtolower($request->province) !== strtolower($shop->province)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'address' => 'We are unable to deliver to this address. Please provide an address within the shop’s service area.',
                ]);
            }
        } elseif ($shop->service_area === 'nationwide') {
            if (strtolower($request->province) === strtolower($shop->province)) {
                $order_type = 'province';
            } elseif (strtolower($request->province) === strtolower($shop->province) ||
                      strtolower($request->city) === strtolower($shop->city)) {
                $order_type = 'local';
            }
        }

        if ($request->delivery_type === 'pick-up') {
            if (
                strtolower($request->province) !== strtolower($shop->province) ||
                strtolower($request->city) !== strtolower($shop->city)
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'delivery_type' => 'Pick-up is only available in ' . $shop->city . ', ' . $shop->province . '.',
                ]);
            }
        }

        $validated = $request->validate($rules);

        return [
            'validated'  => $validated,
            'order_type' => $order_type,
        ];
    }
}
