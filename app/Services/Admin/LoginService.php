<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginService
{
    public const UNAUTHORIZED = 'unauthorized';
    public const INVALID_CREDENTIALS = 'Invalid email or password.';

    public function authenticate(array $credentials, Request $request): bool|string
    {
        if (!Auth::attempt($credentials)) {
            return self::INVALID_CREDENTIALS;
        }

        $user = Auth::user();
        $request->session()->regenerate();

        return $user->role_id === 1 ? true : self::UNAUTHORIZED;
    }
}
