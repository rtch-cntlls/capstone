<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || $user->role_id !== 1 || !Hash::check($validated['password'], $user->password)) {
            return back()->with('error', 'Invalid credentials or unauthorized')->onlyInput('email');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('admin/dashboard');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('admin.login.form');
    }

    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    } 

    public function sendResetLink(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->where('role_id', 1)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No admin account found with this email.']);
        }

        $token = Str::random(64);
        $user->verification_token = $token;
        $user->save();

        Mail::send('emails.admin-reset-password', ['token' => $token, 'user' => $user], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('MotoSmart AI - Admin Password Reset');
        });

        return back()->with('status', 'Reset link sent! Please check your email.');
    }

    public function showResetPasswordForm(string $token)
    {
        $user = User::where('verification_token', $token)->where('role_id', 1)->firstOrFail();
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('verification_token', $request->token)->where('role_id', 1)->firstOrFail();

        $user->password = Hash::make($request->password);
        $user->verification_token = null;
        $user->save();

        return redirect()->route('admin.login.form')->with('status', 'Password reset successfully!');
    }
}
