<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\LoginClientController;
use App\Http\Controllers\Shop\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\LogoutController;

Route::prefix('auth')->name('auth.')->group(function () {
    // Login & Register
    Route::get('login', [LoginClientController::class, 'index'])->name('customer.login');
    Route::post('login', [LoginClientController::class, 'login'])->name('customer.login.submit');
    Route::get('register', [RegisterController::class, 'index'])->name('customer.register');
    Route::post('register', [RegisterController::class, 'register'])->name('customer.register.submit');
    Route::post('register/resend-otp', [RegisterController::class, 'resendOtp'])->name('resend.otp');
    Route::get('/register/back', [RegisterController::class, 'backToEmail'])->name('customer.backToEmail');

    // Social login
    Route::get('google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
    Route::get('facebook/redirect', [FacebookController::class, 'redirect'])->name('facebook.redirect');
    Route::get('facebook/callback', [FacebookController::class, 'callback'])->name('facebook.callback');

    // Logout
    Route::post('/', [LogoutController::class, 'logout'])->name('logout');
});

