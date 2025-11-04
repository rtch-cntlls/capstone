<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacebookLoginService
{
    public function redirect()
    {
        return Socialite::driver('facebook')
            ->scopes(['email'])
            ->redirect();
    }

    public function handleCallback(Request $request)
    {
        try {
            $fbUser = Socialite::driver('facebook')
                ->fields(['first_name', 'last_name', 'email', 'name', 'picture'])
                ->stateless()
                ->user();
        } catch (\Exception $e) {
            return redirect()->route('auth.customer.login')
                ->with('error', 'Facebook login failed. Try again.');
        }
    
        $user = User::where('facebook_id', $fbUser->getId())->first();
    
        if (!$user && $fbUser->getEmail()) {
            $user = User::where('email', $fbUser->getEmail())->first();
    
            if ($user) {
                $user->update([
                    'facebook_id' => $fbUser->getId(),
                    'avatar'      => $fbUser->getAvatar(),
                ]);
            }
        }
    
        if (!$user) {
            if (!$fbUser->getEmail()) {
                return redirect()->route('auth.customer.login')
                    ->with('error', 'We could not retrieve your email from Facebook. Please register manually.');
            }
    
            try {
                DB::transaction(function () use ($fbUser, &$user) {
                    $user = User::create([
                        'firstname'   => $fbUser->user['first_name'] ?? explode(' ', $fbUser->getName())[0] ?? 'Facebook',
                        'lastname'    => $fbUser->user['last_name'] ?? explode(' ', $fbUser->getName())[1] ?? 'User',
                        'email'       => $fbUser->getEmail(),
                        'password'    => null,
                        'facebook_id' => $fbUser->getId(),
                        'avatar'      => $fbUser->getAvatar(),
                        'role_id'     => 2,
                    ]);
    
                    Customer::create([
                        'user_id' => $user->user_id,
                        'phone'   => null,
                    ]);
                });
            } catch (\Exception $e) {
                return redirect()->route('auth.customer.login')
                    ->with('error', 'Unable to create user. Please try again.');
            }
        }
    
        Auth::login($user, true);
        $request->session()->regenerate();
    
        $shop = \App\Models\Shop::first();
        $fullName = trim("{$user->firstname} {$user->lastname}");
        $shopName = $shop->shop_name;
    
        session()->flash('success', "Welcome back, {$fullName}! You’re now logged in to {$shopName}.");
    
        return redirect()->intended('/');
    }
    
}
