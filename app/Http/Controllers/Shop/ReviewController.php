<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{OrderItem, Order, Product, ProductReview};

class ReviewController extends Controller
{
    public function index($product_id, Request $request)
    {
        $product = Product::findOrFail($product_id);

        $query = ProductReview::with(['customer.user', 'replies.admin'])
            ->where('product_id', $product->product_id)
            ->where('status', 'approved')
            ->latest();

        if ($request->filled('stars')) {
            $query->where('rating', (int)$request->get('stars'));
        }
        if ($request->boolean('with_comments')) {
            $query->whereNotNull('comment')->where('comment', '!=', '');
        }
        if ($request->boolean('with_media')) {
            $query->whereNotNull('images');
        }

        $reviews = $query->paginate(10);

        $summary = [
            'average' => round((float) ProductReview::where('product_id', $product->product_id)->avg('rating'), 1),
            'total' => ProductReview::where('product_id', $product->product_id)->count(),
            'counts' => [
                5 => ProductReview::where('product_id', $product->product_id)->where('rating', 5)->count(),
                4 => ProductReview::where('product_id', $product->product_id)->where('rating', 4)->count(),
                3 => ProductReview::where('product_id', $product->product_id)->where('rating', 3)->count(),
                2 => ProductReview::where('product_id', $product->product_id)->where('rating', 2)->count(),
                1 => ProductReview::where('product_id', $product->product_id)->where('rating', 1)->count(),
            ],
            'with_comments' => ProductReview::where('product_id', $product->product_id)->whereNotNull('comment')->where('comment', '!=', '')->count(),
            'with_media' => ProductReview::where('product_id', $product->product_id)->whereNotNull('images')->count(),
        ];

        return response()->json(compact('reviews', 'summary'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_item_id' => 'required|integer|exists:order_items,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|string',
        ]);

        $user = Auth::user();
        abort_unless($user && $user->customer, 403);

        $orderItem = OrderItem::with(['order', 'product'])->findOrFail($data['order_item_id']);

        // Ownership and eligibility checks
        abort_unless(
            $orderItem->order->customer_id === $user->customer->customer_id, 403
        );
        abort_unless($orderItem->order->status === 'completed', 422);
        abort_unless(!$orderItem->addrates, 422);

        $review = ProductReview::create([
            'product_id' => $orderItem->product_id,
            'order_id' => $orderItem->order_id,
            'order_item_id' => $orderItem->id,
            'customer_id' => $user->customer->customer_id,
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
            'images' => $data['images'] ?? null,
        ]);

        $orderItem->addrates = true;
        $orderItem->review_id = $review->id;
        $orderItem->save();

        return response()->json(['message' => 'Review submitted', 'review' => $review]);
    }
}
