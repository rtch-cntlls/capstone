<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Session;
use App\Services\Auth\StoreRegisterService;

class RegisterController extends Controller
{
    protected $registerService;

    public function __construct(StoreRegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function index()
    {
        $shop = Shop::first();
        return view('client.auth.register', compact('shop'));
    }

    public function register(Request $request)
    {
        $step = Session::get('register_step', 'email');

        switch ($step) {
            case 'email':
                return $this->handleEmailStep($request);
            case 'otp':
                return $this->handleOtpStep($request);
            case 'password':
                return $this->handlePasswordStep($request);
            default:
                return back()->withErrors(['error' => 'Unexpected error occurred.']);
        }
    }

    protected function handleEmailStep(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
        ]);
    
        $login = $request->input('login');
    
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {

            if (\App\Models\User::where('email', $login)->exists()) {
                return back()->withErrors(['login' => 'Email is already registered.']);
            }
            Session::put('register_method', 'email');
            Session::put('register_email', $login);
    
            $this->registerService->sendOtp($login, 'email');
            return back()->with('status', 'OTP sent to your email.');
    
        } else {
            if (\App\Models\Customer::where('phone', $login)->exists()) {
                return back()->withErrors(['login' => 'Phone number is already registered.']);
            }
            Session::put('register_method', 'phone');
            Session::put('register_phone', $login);
    
            $this->registerService->sendOtp($login, 'phone');
            return back()->with('status', 'OTP sent to your phone via SMS.');
        }
    }
    
    protected function handleOtpStep(Request $request)
    {
        $request->validate(['otp' => 'required']);
    
        if (!$this->registerService->verifyOtp($request->otp)) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }
    
        Session::put('register_step', 'password');
        return back()->with('status', 'OTP verified. Please create your password.');
    }
    

    protected function handlePasswordStep(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|unique:users,email',
            'firstname' => 'required|string|max:100',
            'lastname'  => 'required|string|max:100',
            'phone'     => 'required|string|max:20',
            'password'  => 'required|string|min:6|confirmed',
        ]);
    
        Session::put('register_email', $request->email);
    
        $user = $this->registerService->createUser(
            $request->password,
            $request->firstname,
            $request->lastname,
            $request->phone
        );
    
        $sessions = $request->only(['buy_now', 'wishlist_pending', 'cart_pending', 'booking_pending']);
        $request->session()->regenerate(true);
        foreach ($sessions as $key => $value) {
            if ($value !== null) {
                $request->session()->put($key, $value);
            }
        }
    
        return redirect()
            ->route('auth.customer.login')
            ->with('success', 'Your account has been created successfully! You can now log in.');
    }
    

    public function resendOtp()
    {
        if (!Session::has('register_email')) {
            return redirect()->back()->withErrors([
                'email' => 'No email found in session. Please start over.'
            ]);
        }

        $this->registerService->resendOtp();

        return back()->with('success', 'A new OTP has been sent to your email.');
    }

    public function backToEmail()
    {
        Session::forget(['register_email', 'register_otp', 'register_step']);

        return redirect()->route('auth.customer.register')
            ->with('status', 'You can now re-enter your email to restart registration.');
    }
}
