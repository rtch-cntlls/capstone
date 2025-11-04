<?php

namespace App\Services\Shop;

use App\Models\Product;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ProductService
{
    public function getProductDetails($product_id, $fullDescription = false)
    {
        $shop = Shop::first();
        $product = Product::with('discounts', 'category')->findOrFail($product_id);

        $discount = $product->discounts->first(fn($d) => $d->status === 'Active');
        $discountPercentage = (int) ($discount->discount_percent ?? 0);

        $originalPrice = $product->sale_price;
        $discountedPrice = $discountPercentage > 0
            ? $originalPrice * (1 - ($discountPercentage / 100))
            : $originalPrice;
        $discountAmount = $originalPrice - $discountedPrice;

        $promoDate = $discount?->expiry_date
            ? Carbon::parse($discount->expiry_date)->format('M d, Y')
            : '';

        $description = $fullDescription
            ? $product->description
            : \Illuminate\Support\Str::limit($product->description, 100);


        $recommendedProducts = Product::with('discounts')
            ->where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->where('status', 'Active')
            ->take(4)
            ->get()
            ->map(function ($related) {
                $discount = $related->discounts->first(fn($d) => $d->status === 'Active');
                $discountPercentage = (int) ($discount->discount_percent ?? 0);
                $originalPrice = $related->sale_price;
                $discountedPrice = $discountPercentage > 0
                    ? $originalPrice * (1 - ($discountPercentage / 100))
                    : $originalPrice;

                return [
                    'product_id' => $related->product_id,
                    'product_name' => $related->product_name,
                    'sale_price' => number_format($discountedPrice, 2),
                    'original_price' => number_format($originalPrice, 2),
                    'discount_percentage' => $discountPercentage,
                    'image' => $related->image,
                ];
            });

        return compact( 'shop', 'product', 'discountedPrice', 'discountPercentage',
            'originalPrice', 'promoDate', 'description', 'fullDescription', 'discountAmount', 'recommendedProducts'
        );
    }    
}
