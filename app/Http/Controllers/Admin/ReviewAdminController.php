<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ProductReview, ProductReviewReply};

class ReviewAdminController extends Controller
{
    public function reply(Request $request, $reviewId)
    {
        $data = $request->validate([
            'comment' => 'required|string'
        ]);

        $review = ProductReview::findOrFail($reviewId);

        $reply = ProductReviewReply::create([
            'review_id' => $review->id,
            'admin_user_id' => auth()->id(),
            'comment' => $data['comment'],
        ]);

        return back()->with('success', 'Reply posted.');
    }
}
