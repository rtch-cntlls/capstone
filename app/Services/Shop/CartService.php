<?php

namespace App\Services\Shop;

use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getCartItems()
    {
        $customerId = $this->getCustomerId();
        $cartItems = Cart::with('product')->where('customer_id', $customerId)->get();

        foreach ($cartItems as $cartItem) {
            $cartItem->discounted_price = $this->getDiscountedPrice($cartItem);
            $cartItem->total_price = $cartItem->discounted_price * $cartItem->quantity;
        }

        return $cartItems;
    }

    public function getSelectedItems()
    {
        $customerId = $this->getCustomerId();
        $cartItems = Cart::with('product')
            ->where('customer_id', $customerId)
            ->where('selected', true)
            ->get();

        foreach ($cartItems as $cartItem) {
            $cartItem->discounted_price = $this->getDiscountedPrice($cartItem);
            $cartItem->total_price = $cartItem->discounted_price * $cartItem->quantity;
        }

        return $cartItems;
    }

    public function toggleSelection(int $productId, bool $selected)
    {
        $customerId = $this->getCustomerId();
        Cart::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->update(['selected' => $selected]);
    }

    public function addToCart(int $productId, int $quantity)
    {
        return DB::transaction(function () use ($productId, $quantity) {
            $customerId = $this->getCustomerId();

            $cartItem = Cart::firstOrNew([
                'customer_id' => $customerId,
                'product_id'  => $productId,
            ]);

            $cartItem->quantity = ($cartItem->quantity ?? 0) + $quantity;
            $cartItem->save();

            return $cartItem;
        });
    }

    public function removeFromCart(int $productId): void
    {
        $customerId = $this->getCustomerId();
        Cart::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->delete();
    }

    protected function getCustomerId(): ?int
    {
        return Customer::where('user_id', Auth::id())->value('customer_id');
    }

    protected function getDiscountedPrice($cartItem): float
    {
        $price = $cartItem->product->sale_price;

        $promo = DB::table('promo_products')
            ->join('discounts', 'promo_products.discount_id', '=', 'discounts.discount_id')
            ->where('promo_products.product_id', $cartItem->product->product_id)
            ->where('discounts.status', 'Active')
            ->whereDate('discounts.start_date', '<=', now())
            ->whereDate('discounts.expiry_date', '>=', now())
            ->first();

        return $promo ? $price * (1 - $promo->discount_percent / 100) : $price;
    }
}
