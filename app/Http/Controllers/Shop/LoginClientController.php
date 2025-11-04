<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Services\Auth\StoreLoginService;

class LoginClientController extends Controller
{
    protected $loginHandler;

    public function __construct(StoreLoginService $loginHandler)
    {
        $this->loginHandler = $loginHandler;
    }

    public function index()
    {
        $shop = Shop::first();
        return view('client.auth.login', compact('shop'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user(); 
            $shop = Shop::first(); 
            $welcomeMessage = "Welcome back, {$user->name}! You’re now logged in to {$shop->name}.";
            session()->flash('success', $welcomeMessage);

            return $this->loginHandler->handlePostLogin($request);
        }

        return back()->with('error', 'Invalid credentials. Please try again.')
                     ->onlyInput('email');
    }
}