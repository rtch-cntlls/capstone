<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Shop\WishlistService;
use App\Services\Shop\CartService;

class StoreLoginService
{
    protected $wishlistService;
    protected $cartService;

    public function __construct(WishlistService $wishlistService, CartService $cartService)
    {
        $this->wishlistService = $wishlistService;
        $this->cartService = $cartService;
    }

    public function handlePostLogin(Request $request)
    {
        $user = Auth::user();

        if ($user->role_id != 2) {
            return redirect()->intended('/');
        }

        $sessions = $request->only([
            'buy_now', 'wishlist_pending', 'cart_pending', 'booking_pending'
        ]);

        $request->session()->regenerate(true);

        foreach ($sessions as $key => $value) {
            if ($value !== null) {
                $request->session()->put($key, $value);
            }
        }

        return $this->handlePendingActions($request);
    }

    protected function handlePendingActions(Request $request)
    {
        if ($response = $this->handleBookingPending($request)) return $response;
        if ($response = $this->handleWishlistPending($request)) return $response;
        if ($response = $this->handleBuyNow($request)) return $response;
        if ($response = $this->handleCartPending($request)) return $response;

        return redirect()->intended('/');
    }

    protected function handleBookingPending(Request $request)
    {
        if ($request->session()->has('booking_pending')) {
            $serviceId = $request->session()->pull('booking_pending');
            return redirect()->route('shop-services.CreateBooking', $serviceId);
        }
        return null;
    }

    protected function handleWishlistPending(Request $request)
    {
        if ($request->session()->has('wishlist_pending')) {
            $pending = $request->session()->pull('wishlist_pending', []);
            foreach ($pending as $productId) {
                $this->wishlistService->addToWishlist($productId);
            }
            return redirect()->route('wishlist.index');
        }
        return null;
    }

    protected function handleBuyNow(Request $request)
    {
        if ($request->session()->has('buy_now')) {
            return redirect()->route('checkout.checkout');
        }
        return null;
    }

    protected function handleCartPending(Request $request)
    {
        if ($request->session()->has('cart_pending')) {
            $pendingCart = $request->session()->pull('cart_pending', []);
            foreach ($pendingCart as $item) {
                $this->cartService->addToCart($item['product_id'], $item['quantity']);
            }
            return redirect()->route('cart.index');
        }
        return null;
    }
}
