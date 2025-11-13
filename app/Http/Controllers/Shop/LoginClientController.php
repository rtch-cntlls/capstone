<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Services\Auth\StoreLoginService;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);
    
        $loginInput = $request->input('login');

        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $loginInput)->first();
        } else {
            $customer = Customer::where('phone', $loginInput)->first();
            $user = $customer ? $customer->user : null;
        }
    
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
    
            $shop = Shop::first();
            $welcomeMessage = "Welcome back, {$user->firstname}! You’re now logged in to {$shop->shop_name}.";
            session()->flash('success', $welcomeMessage);
    
            return $this->loginHandler->handlePostLogin($request);
        }
    
        return back()->with('error', 'Invalid credentials. Please try again.')
                     ->onlyInput('login');
    }
}