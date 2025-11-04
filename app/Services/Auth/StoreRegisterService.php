<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Mail\SendOtpMail;
use App\Services\Shop\WishlistService;

class StoreRegisterService
{
    protected $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function sendOtp(string $login, string $method = 'email'): void
    {
        $otp = rand(100000, 999999);
        Session::put('register_otp', $otp);
        Session::put('register_step', 'otp');
    
        if ($method === 'email') {
            Session::put('register_email', $login);
            Mail::to($login)->send(new SendOtpMail($otp));
        } else {
            Session::put('register_phone', $login);
            $smsService = app(\App\Services\Notification\SmsService::class);
            $smsService->sendSms($login, "Your OTP code is: $otp");
        }
    }
    
    public function verifyOtp(string $otp): bool
    {
        return $otp == Session::get('register_otp');
    }
    

    public function resendOtp(): void
    {
        $otp = rand(100000, 999999);
        Session::put('register_otp', $otp);
        Mail::to(Session::get('register_email'))->send(new SendOtpMail($otp));
    }

    public function createUser(string $password, string $firstname, string $lastname, string $phone = null): User
    {
        return DB::transaction(function () use ($password, $firstname, $lastname, $phone) {
            $email = Session::get('register_email');
            $phone = Session::get('register_phone');
    
            $user = User::create([
                'email'     => $email,
                'password'  => bcrypt($password),
                'role_id'   => 2,
                'firstname' => $firstname,
                'lastname'  => $lastname,
            ]);
    
            Customer::create([
                'user_id' => $user->user_id,
                'phone'   => $phone,
            ]);
    
            Session::forget(['register_email','register_phone','register_otp','register_step']);
    
            return $user;
        });
    }    

    public function handlePostRegistrationSessions($request, User $user)
    {
        $request->session()->regenerate(true);

        if ($user->role_id != 2) {
            return null;
        }

        if ($response = $this->handleBookingPending($request)) {
            return $response;
        }

        if ($response = $this->handleWishlistPending($request)) {
            return $response;
        }

        if ($response = $this->handleBuyNow($request)) {
            return $response;
        }

        return null;
    }

    protected function handleBookingPending($request)
    {
        if ($bookingPending = session()->pull('booking_pending')) {
            return redirect()->route('shop-services.CreateBooking', $bookingPending);
        }
        return null;
    }

    protected function handleWishlistPending()
    {
        $pendingWishlist = session()->pull('wishlist_pending', []);
        if (!empty($pendingWishlist)) {
            foreach ($pendingWishlist as $productId) {
                $this->wishlistService->addToWishlist($productId);
            }
            return redirect()->route('wishlist.index');
        }
        return null;
    }

    protected function handleBuyNow($request)
    {
        if ($request->session()->has('buy_now')) {
            return redirect()->route('checkout.checkout');
        }
        return null;
    }
}
