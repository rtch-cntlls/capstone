<?php

namespace App\Services\Shop;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{
    public function placeCheckout(Request $request, $shop, $order_type)
    {
        $singleOrder = Session::get('buy_now');
        $cartOrders  = Session::get('cart_checkout');

        $orderItemsData = $singleOrder ? [$singleOrder] : ($cartOrders ?? []);

        if (empty($orderItemsData)) {
            return null;
        }
        $this->updateUserCustomerInfo($request);
        $customerId = $this->getCustomerId($orderItemsData);

        $productIds = array_map(fn($item) => $item['product_id'], $orderItemsData);

        $duplicateOrderItem = OrderItem::whereHas('order', function($query) use ($customerId) {
                $query->where('customer_id', $customerId)
                    ->whereNotIn('status', ['completed', 'cancelled']);
            })
            ->whereIn('product_id', $productIds)
            ->first();

        if ($duplicateOrderItem) {
            throw new \Exception('You already have a pending order with this product. Please complete it before ordering again.');
        }

        try {
            DB::transaction(function () use ($request, $orderItemsData, $shop, $order_type, &$order, $customerId) {

                $address = $this->createAddress($customerId, $request);

                $deliveryFee = $request->delivery_type === 'deliver'
                    ? floatval($request->delivery_fee ?? 0)
                    : 0;

                $subtotal = array_sum(array_map(fn($item) => $item['subtotal'], $orderItemsData));
                $grandTotal = $subtotal + $deliveryFee;

                $order = Order::create([
                    'customer_id'    => $customerId,
                    'address_id'     => $address->address_id,
                    'order_number'   => strtoupper(Str::random(10)),
                    'status'         => 'pending',
                    'payment_status' => 'unpaid',
                    'payment_method' => $request->payment_method,
                    'delivery_type'  => $request->delivery_type,
                    'subtotal'       => $subtotal,
                    'grand_total'    => $grandTotal,
                    'placed_at'      => now(),
                    'order_type'     => $order_type,
                ]);

                foreach ($orderItemsData as $itemData) {
                    $this->createOrderItem($order, $itemData, $deliveryFee);
                    $this->updateInventory($itemData);
                }

                Session::forget(['buy_now', 'cart_checkout']);
            });
        } catch (\Exception $e) {
            return null;
        }

        return $order ?? null;
    }

    protected function getCustomerId(array &$orderItemsData)
    {
        if (isset($orderItemsData[0]['customer_id'])) {
            return $orderItemsData[0]['customer_id'];
        }

        $user = Auth::user();
        if (!$user) {
            return null;
        }

        $customer = $user->customer;
        if (!$customer) {
            return null;
        }

        $customerId = $customer->customer_id;

        foreach ($orderItemsData as &$item) {
            $item['customer_id'] = $customerId;
        }
        Session::put('buy_now', $orderItemsData);
        Session::put('cart_checkout', $orderItemsData);

        return $customerId;
    }

    protected function updateUserCustomerInfo(Request $request)
    {
        $user = Auth::user();
        if (!$user) return;

        $customer = $user->customer;
        if (!$customer) return;

        $updated = false;

        if ($request->filled('firstname') && empty($user->firstname)) {
            $user->firstname = $request->firstname;
            $updated = true;
        }
        if ($request->filled('lastname') && empty($user->lastname)) {
            $user->lastname = $request->lastname;
            $updated = true;
        }
        if ($request->filled('email') && empty($user->email)) {
            $user->email = $request->email;
            $updated = true;
        }
        if ($updated) {
            $user->save();
        }

        if ($request->filled('phone') && empty($customer->phone)) {
            $customer->phone = $request->phone;
            $customer->save();
        }
    }

    protected function createAddress($customerId, Request $request)
    {
        $existingAddress = Address::where('customer_id', $customerId)
            ->where('province', $request->province)
            ->where('city', $request->city)
            ->where('barangay', $request->barangay)
            ->where('street', $request->street)
            ->where('postal_code', $request->postal_code)
            ->first();

        if ($existingAddress) {
            return $existingAddress;
        }

        return Address::create([
            'customer_id' => $customerId,
            'province'    => $request->province,
            'city'        => $request->city,
            'barangay'    => $request->barangay,
            'street'      => $request->street,
            'postal_code' => $request->postal_code,
        ]);
    }

    protected function createOrderItem($order, $itemData, $deliveryFee)
    {
        $total = $itemData['subtotal'] + $deliveryFee;

        return OrderItem::create([
            'order_id'     => $order->order_id,
            'product_id'   => $itemData['product_id'],
            'product_name' => $itemData['product_name'],
            'price'        => $itemData['price'],
            'discount'     => $itemData['discount'] ?? 0,
            'quantity'     => $itemData['quantity'],
            'delivery_fee' => $deliveryFee,
            'total'        => $total,
        ]);
    }

    protected function updateInventory($orderData)
    {
        $inventory = Inventory::where('product_id', $orderData['product_id'])->first();
        if (!$inventory) return;

        $inventory->available_stock = max($inventory->available_stock - $orderData['quantity'], 0);

        $inventory->stock_status = match (true) {
            $inventory->available_stock == 0 => 'out_of_stock',
            $inventory->available_stock < 3 => 'low_stock',
            default => 'in_stock',
        };
        
        $inventory->save();
    }
}
