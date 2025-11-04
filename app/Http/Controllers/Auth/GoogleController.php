<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\GoogleAuthService;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(GoogleAuthService $googleAuthService)
    {
        try {
            return $googleAuthService->handleGoogleLogin();
        } catch (\Exception $e) {
            return redirect()->route('auth.customer.login');
        }
    }
}
