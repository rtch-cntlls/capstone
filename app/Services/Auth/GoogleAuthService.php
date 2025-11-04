<?php

namespace App\Services\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use App\Services\Shop\CartService;
use App\Services\Shop\WishlistService;
use Illuminate\Support\Facades\DB;

class GoogleAuthService
{
    protected $cartService;
    protected $wishlistService;

    public function __construct(CartService $cartService, WishlistService $wishlistService)
    {
        $this->cartService = $cartService;
        $this->wishlistService = $wishlistService;
    }

    public function handleGoogleLogin()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = DB::transaction(function () use ($googleUser) {
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'firstname' => $googleUser->user['given_name'] ?? 'Google',
                    'lastname'  => $googleUser->user['family_name'] ?? 'User',
                    'password'  => null,
                    'role_id'   => 2,
                    'profile'   => $googleUser->getAvatar(),
                ]
            );

            if (!$user->customer) {
                Customer::create([
                    'user_id' => $user->user_id,
                    'phone'   => null,
                ]);
            }

            return $user;
        });

        Auth::login($user);
        $shop = \App\Models\Shop::first();
        $fullName = trim("{$user->firstname} {$user->lastname}");
        $shopName = $shop->shop_name;
    
        $welcomeMessage = "Welcome back, {$fullName}! You’re now logged in to {$shopName}.";
        session()->flash('success', $welcomeMessage);
        return $this->handlePendingActions($user);
    }

    protected function handlePendingActions($user)
    {
        if ($user->role_id != 2) {
            return redirect()->intended('/');
        }

        if ($response = $this->handleBookingPending()) {
            return $response;
        }

        if ($response = $this->handleWishlistPending()) {
            return $response;
        }

        if ($response = $this->handleBuyNow()) {
            return $response;
        }

        if ($response = $this->handleCartPending()) {
            return $response;
        }

        return redirect()->intended('/');
    }

    protected function handleBookingPending()
    {
        if (session()->has('booking_pending')) {
            $serviceId = session()->pull('booking_pending');
            return redirect()->route('shop-services.CreateBooking', $serviceId);
        }
        return null;
    }

    protected function handleWishlistPending()
    {
        if (session()->has('wishlist_pending')) {
            $pending = session()->pull('wishlist_pending', []);
            foreach ($pending as $productId) {
                $this->wishlistService->addToWishlist($productId);
            }
            return redirect()->route('wishlist.index');
        }
        return null;
    }

    protected function handleBuyNow()
    {
        if (session()->has('buy_now')) {
            return redirect()->route('checkout.checkout');
        }
        return null;
    }

    protected function handleCartPending()
    {
        if (session()->has('cart_pending')) {
            $pendingCart = session()->pull('cart_pending', []);
            foreach ($pendingCart as $item) {
                $this->cartService->addToCart($item['product_id'], $item['quantity']);
            }
            return redirect()->route('cart.index');
        }
        return null;
    }
}
