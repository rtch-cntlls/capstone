<?php

namespace App\Services\Shop;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getCustomerOrders($perPage = 9, ?string $status = null)
    {
        $customer = Auth::user()->customer;

        if (!$customer) return collect();

        $query = $customer->orders()->with(['customer', 'orderItems.product'])->orderBy('placed_at', 'desc');

        if ($status) {
            $query->where('status', strtolower($status));
        } else {
            $query->whereNotIn('status', ['completed', 'cancelled', 'failed']);
        }

        return $query->paginate($perPage)->withQueryString();
    }    

    public function getCustomerOrder(int $orderId): Order
    {
        $customer = Auth::user()->customer;

        return Order::with('orderItems.product', 'address')
            ->where('customer_id', $customer->customer_id)
            ->findOrFail($orderId);
    }

    public function cancelCustomerOrder(int $orderId): void
    {
        $customer = Auth::user()->customer;
    
        $order = Order::with('orderItems.product.inventory')
            ->where('customer_id', $customer->customer_id)
            ->whereIn('status', ['pending', 'processing'])
            ->findOrFail($orderId);
    
        DB::transaction(function () use ($order) {
            foreach ($order->orderItems as $item) {
                if ($item->product && $item->quantity > 0) {
                    $product = $item->product;
                    $inventory = $product->inventory ?? null;
    
                    if ($product->isFillable('stock')) {
                        $product->increment('stock', $item->quantity);
                    }
    
                    if ($inventory) {
                        $inventory->instock += $item->quantity;
                        $inventory->available_stock += $item->quantity;

                        if ($inventory->instock <= 0) {
                            $inventory->stock_status = 'out_of_stock';
                        } elseif ($inventory->instock < 3) {
                            $inventory->stock_status = 'low_stock';
                        } else {
                            $inventory->stock_status = 'in_stock';
                        }
    
                        $inventory->save();
                    }
                }
            }

            $order->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);
        });
    }     
}
