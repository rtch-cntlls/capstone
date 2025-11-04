<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Shop\WishlistService;
use App\Models\Shop;

class WishlistController extends Controller
{
    protected $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        if (!Auth::check() || Auth::user()->role_id != 2) {
            return redirect()->route('auth.customer.login');
        }
    
        $shop = Shop::first();
        $wishlist = $this->wishlistService->getWishlist();
    
        return view('client.pages.wishlist.index', compact('shop', 'wishlist'));
    }

    public function addToWishlist(Request $request)
    {
        try {
            $productId = (int) $request->input('product_id');

            if (Auth::check() && Auth::user()->role_id == 2) {
                $added = $this->wishlistService->addToWishlist($productId);

                $message = $added 
                    ? 'Product added to wishlist!' 
                    : 'Product already in wishlist!';

                return redirect()->back()->with('success', $message);
            }

            $pendingWishlist = session()->get('wishlist_pending', []);
            if (!in_array($productId, $pendingWishlist)) {
                $pendingWishlist[] = $productId;
            }
            session()->put('wishlist_pending', $pendingWishlist);

            return redirect()->route('auth.customer.login');

        } catch (\Exception) {
            return response()->view('error.shop500');
        }
    }

    public function removeFromWishlist(Request $request)
    {
        $productId = $request->input('product_id');

        try {
            $this->wishlistService->removeFromWishlist($productId);
            return redirect()->back()->with('success', 'Product removed from wishlist.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove product.');
        }
    }
}
