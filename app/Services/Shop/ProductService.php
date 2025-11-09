<?php

namespace App\Services\Shop;

use App\Models\Product;
use App\Models\Shop;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\ProductReview;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function getProductDetails($product_id)
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

        // Ratings summary
        $averageRating = round((float) ProductReview::where('product_id', $product->product_id)->avg('rating'), 1);
        $totalReviews = ProductReview::where('product_id', $product->product_id)->count();
        $starCounts = [
            5 => ProductReview::where('product_id', $product->product_id)->where('rating', 5)->count(),
            4 => ProductReview::where('product_id', $product->product_id)->where('rating', 4)->count(),
            3 => ProductReview::where('product_id', $product->product_id)->where('rating', 3)->count(),
            2 => ProductReview::where('product_id', $product->product_id)->where('rating', 2)->count(),
            1 => ProductReview::where('product_id', $product->product_id)->where('rating', 1)->count(),
        ];
        $withCommentsCount = ProductReview::where('product_id', $product->product_id)
            ->whereNotNull('comment')->where('comment', '!=', '')->count();
        $withMediaCount = ProductReview::where('product_id', $product->product_id)
            ->whereNotNull('images')->count();

        // Eligibility to rate (has completed order for this product and not yet rated a specific order item)
        $canRate = false;
        $rateableOrderItemId = null;
        if ($user = Auth::user()) {
            $customer = $user->customer ?? null;
            if ($customer) {
                $orderItem = OrderItem::whereHas('order', function ($q) use ($customer) {
                        $q->where('customer_id', $customer->customer_id)
                          ->where('status', 'completed');
                    })
                    ->where('product_id', $product->product_id)
                    ->where(function ($q) {
                        $q->whereNull('addrates')->orWhere('addrates', false);
                    })
                    ->latest()
                    ->first();
                if ($orderItem) {
                    $canRate = true;
                    $rateableOrderItemId = $orderItem->id;
                }
            }
        }

        return compact( 'shop', 'product', 'discountedPrice', 'discountPercentage',
            'originalPrice', 'promoDate', 'discountAmount', 'recommendedProducts',
            'averageRating', 'totalReviews', 'starCounts', 'withCommentsCount', 'withMediaCount',
            'canRate', 'rateableOrderItemId'
        );
    }    
}
