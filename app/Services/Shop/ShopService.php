<?php

namespace App\Services\Shop;

use App\Models\Product;
use Carbon\Carbon;

class ShopService
{
    public function getProducts($filters = [])
    {
        return Product::with('discounts')
            ->where('status', 'Active')
            ->when($filters['new'] ?? false, fn($q) => $q->where('condition', 'New'))
            ->when($filters['sale'] ?? false, fn($q) =>
                $q->whereHas('discounts', fn($q) => $q->where('discount_percent', '>', 0)->where('status', 'Active')))
            ->when(!empty($filters['categories']), fn($q) =>
                $q->whereIn('category_id', $filters['categories']))
            ->latest()
            ->get()
            ->map(fn($product) => $this->formatProduct($product));
    }
    
    protected function formatProduct($product)
    {
        $discount = $product->discounts->first(fn($d) => $d->status === 'Active');
        $discountPercentage = (int) ($discount->discount_percent ?? 0);
    
        $originalPrice = $product->sale_price;
        $discountedPrice = $discountPercentage > 0
            ? $originalPrice * (1 - ($discountPercentage / 100))
            : $originalPrice;
    
        return [
            'product_id' => $product->product_id,
            'product_name' => $product->product_name,
            'condition' => $product->condition,
            'original_price' => number_format($originalPrice, 2),
            'sale_price' => number_format($discountedPrice, 2),
            'discount_percentage' => $discountPercentage,
            'expiry_date' => $discount?->expiry_date
                ? Carbon::parse($discount->expiry_date)->format('M d, Y')
                : '',
            'image' => $product->image,
        ];
    }    
}
