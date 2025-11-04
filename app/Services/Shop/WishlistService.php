<?php

namespace App\Services\Shop;

use App\Models\Wishlist;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistService
{
    public function getCustomerId()
    {
        return Customer::where('user_id', Auth::id())->value('customer_id');
    }

    public function addToWishlist(int $productId): bool
    {
        $customerId = $this->getCustomerId();
        if (!$customerId) {
            return false;
        }
        return DB::transaction(function () use ($customerId, $productId) {
            $exists = Wishlist::where('customer_id', $customerId)->where('product_id', $productId)->exists();

            if (!$exists) {
                Wishlist::create([
                    'customer_id' => $customerId,
                    'product_id' => $productId
                ]);
                return true;
            }
            return false;
        });
    }
    
    public function removeFromWishlist(int $productId)
    {
        $customerId = $this->getCustomerId();
        if (!$customerId) return;

        Wishlist::where('customer_id', $customerId)
                ->where('product_id', $productId)
                ->delete();
    }

    public function getWishlist()
    {
        $customerId = $this->getCustomerId();
        if (!$customerId) {
            return [];
        }
        return Wishlist::where('customer_id', $customerId)
            ->get()
            ->map(function ($item) {
                $discountPercent = $item->product->discounts->first()?->discount_percent ?? 0;
                $salePrice = ($item->product->sale_price ?? 0) * (1 - ($discountPercent / 100));

                return [
                    'customer_id' => $item->customer_id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->product_name,
                    'category' => $item->product->category->name ?? 'N/A',
                    'original_price' => number_format($item->product->sale_price ?? 0, 2),
                    'discount_percentage' => $discountPercent,
                    'sale_price' => number_format($salePrice, 2),
                    'image' => $item->product->image,
                ];
            });
    }
}
