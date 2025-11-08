<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderOutForDeliveryMail;
use App\Mail\OrderReadyForPickupMail;
use App\Mail\OrderShippedMail;
use Illuminate\Support\Facades\Mail;
use App\Services\Notification\SmsService;

class OrderService
{
    protected SmsService $smsService;

    public function __construct()
    {
        $this->smsService = new SmsService();
    }

    public function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('customer.user', function ($q) use ($search) {
                $q->where('firstname', 'like', "%$search%")
                ->orWhere('lastname', 'like', "%$search%");
            });
        }

        if ($request->filled('order_type')) {
            $query->where('order_type', $request->order_type);
        }

        return $query;
    }

    public function getOrdersAndCards(Request $request): array
    {
        $showAllStatuses = strtolower($request->status ?? '') === 'total_orders';
    
        $query = Order::with(['customer.user']);

        $query = $this->applyFilters($query, $request);
    
        $query->when($request->filled('status') && !$showAllStatuses, function ($q) use ($request) {
            $status = strtolower($request->status);
            if (in_array($status, ['pending', 'completed', 'cancelled'])) {
                $q->where('status', $status);
            }
        }, function ($q) use ($showAllStatuses) {
            if (!$showAllStatuses) {
                $q->whereNotIn('status', ['completed', 'cancelled']);
            }
        });

        $orders = $query->latest()->paginate(10)->withQueryString();

        $allStatuses = ['pending','processing','out_for_delivery','ready_for_pick_up','shipped','completed','cancelled'];
        $stats = Order::select('status', DB::raw('COUNT(*) as total'))
            ->whereIn('status', $allStatuses)
            ->groupBy('status')
            ->pluck('total', 'status');
    
        $cards = [
            [
                'title' => 'Total Orders', 
                'value' => Order::count(), 
                'type' => 'Orders', 
                'icon' => 'fas fa-shopping-cart', 
                'color' => 'text-primary',
                'link'  => route('admin.orders.index', ['status' => 'total_orders'])
            ],
            ['title' => 'Pending', 'value' => $stats['pending'] ?? 0, 'type' => 'Orders', 'icon' => 'fas fa-clock', 'color' => 'text-warning'],
            ['title' => 'Completed', 'value' => $stats['completed'] ?? 0, 'type' => 'Orders', 'icon' => 'fas fa-check-circle', 'color' => 'text-success'],
            ['title' => 'Cancelled', 'value' => $stats['cancelled'] ?? 0, 'type' => 'Orders', 'icon' => 'fas fa-times-circle', 'color' => 'text-danger'],
        ];
    
        return [$orders, $cards];
    }    

    public function getOrderById(int $orderId): Order
    {
        return Order::with(['customer.user', 'orderItems.product.inventory', 'shipment'])
            ->findOrFail($orderId);
    }

    public function updateStatus(
        int $orderId,
        string $status,
        ?string $estimatedDate = null,
        ?string $courier = null,
        ?string $trackingNumber = null,
        ?string $expectedDeliveryDate = null
    ): Order
    {
        return DB::transaction(function () use (
            $orderId, 
            $status, 
            $estimatedDate, 
            $courier, 
            $trackingNumber, 
            $expectedDeliveryDate,
        ) {
            $order = $this->getOrderById($orderId);
            $order->status = $status;
    
            match ($status) {
                'completed' => $this->handleCompleted($order, $expectedDeliveryDate),
                'cancelled' => $this->handleCancelled($order),
                'out_for_delivery' => $this->handleOutForDelivery($order, $estimatedDate, $courier, $trackingNumber),
                'ready_for_pick_up' => $this->handleReadyForPickup($order),
                'shipped' => $this->handleShipped($order, $courier, $trackingNumber),
                default => null,
            };
    
            $order->save();
    
            return $order;
        });
    }
    

    public function autoCompleteShippedOrders(): int
    {
        $updatedCount = 0;

        Order::where('status', 'shipped')
            ->where(function ($q) {
                $q->whereHas('shipment', fn($sq) => $sq->whereDate('expected_delivery_date', '<=', now()->toDateString()))
                  ->orWhereDate('expected_delivery_date', '<=', now()->toDateString());
            })
            ->with('shipment')
            ->chunkById(100, function ($orders) use (&$updatedCount) {
                foreach ($orders as $order) {
                    $this->updateStatus($order->order_id, 'completed');
                    $updatedCount++;
                }
            });

        return $updatedCount;
    }

    private function handleCompleted(Order $order, ?string $expectedDeliveryDate): void
    {
        $order->payment_status = $order->payment_status === 'unpaid' ? 'paid' : $order->payment_status;
        $order->delivered_at = $expectedDeliveryDate;

        if ($order->shipment) {
            $order->shipment->update(['delivered_at' => now()]);
        }

        $sale = Sale::create([
            'order_id'    => $order->order_id,
            'customer_id' => $order->customer->customer_id,
            'sale_type'   => 'online_order',
            'sale_date'   => now(),
            'amount_pay'  => $order->grand_total,
            'change'      => 0,
            'grand_total' => $order->grand_total,
        ]);

        foreach ($order->orderItems as $item) {
            SaleItem::create([
                'sale_id'    => $sale->sale_id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->price,
                'discount'   => $item->discount ?? 0,
               'total'       => $order->subtotal
            ]);
        }
    }

    private function handleCancelled(Order $order): void
    {
        foreach ($order->orderItems as $item) {
            $inventory = $item->product->inventory ?? null;
            if ($inventory) {
                $inventory->available_stock += $item->quantity;

                if ($inventory->available_stock <= 0) {
                    $inventory->stock_status = 'out_of_stock';
                } elseif ($inventory->available_stock < 3) {
                    $inventory->stock_status = 'low_stock';
                } else {
                    $inventory->stock_status = 'in_stock';
                }

                $inventory->save();
            }
        }
    }

    private function handleOutForDelivery(Order $order, ?string $estimatedDate, ?string $courier, ?string $trackingNumber): void
    {
        
        if ($order->order_type === 'province' || $order->order_type === 'local') {
            $shipment = Shipment::create([
                'order_id'               => $order->order_id,
                'courier'                => $courier,
                'tracking_number'        => $trackingNumber,
                'shipped_at'             => null,
            ]);
            $order->setRelation('shipment', $shipment);
        }
    
        $order->load('customer.user');
        $order->expected_delivery_date = $estimatedDate;
    
        Mail::to($order->customer->user->email)
            ->send(new OrderOutForDeliveryMail($order));
    
        if (!empty($order->customer->phone)) {
            $message = "Your order #{$order->order_id} is out for delivery and will arrive by {$estimatedDate}.  Tracking #: {$trackingNumber}.";
            $this->smsService->sendSms($order->customer->phone, $message);
        }
    }
    
    private function handleReadyForPickup(Order $order): void
    {
        $order->expected_delivery_date = now();
    
        Mail::to($order->customer->user->email)
            ->send(new OrderReadyForPickupMail($order));
    
        if (!empty($order->customer->phone)) {
            $message = "Your order #{$order->order_id} is ready for pickup at the shop.";
            $this->smsService->sendSms($order->customer->phone, $message);
        }
    }
    
    private function handleShipped(Order $order, ?string $courier, ?string $trackingNumber): void
    {
        if ($order->order_type === 'nationwide') {
            $shipment = Shipment::create([
                'order_id'               => $order->order_id,
                'courier'                => $courier,
                'tracking_number'        => $trackingNumber,
                'shipped_at'             => now(),
            ]);
            $order->setRelation('shipment', $shipment);
        }
    
        $order->load('customer.user');
    
        Mail::to($order->customer->user->email)
            ->send(new OrderShippedMail($order));
    
        if (!empty($order->customer->phone)) {
            $message = "Your order #{$order->order_id} has been shipped via {$courier}. Tracking #: {$trackingNumber}.";
            $this->smsService->sendSms($order->customer->phone, $message);
        }
    }
    
}
