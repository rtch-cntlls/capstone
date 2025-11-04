<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\SettingsService;
use App\Models\Shop;
use App\Models\PaymentMethods;

class SettingsController extends Controller
{
    protected $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        try {
            $shop = Shop::first();
            $admin = $this->settingsService->getAuthenticatedAdmin();
            $methods = PaymentMethods::all();
            return view('admin.pages.setting.index', compact('shop','admin','methods'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function updateOrderSettings(Request $request, $id)
    {
        try {
            $this->settingsService->updateOrderSettings($request, $id);
            return back();
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function updateStoreDetails(Request $request, $id)
    {
        try {
            $this->settingsService->updateStoreDetails($request, $id);
            return back();
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function updateAdminAccount(Request $request, $id)
    { 
        try {
            $this->settingsService->updateAdminAccount($request, $id);
            return back()->with('success', 'Admin account updated successfully.');
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        try {
            if (!$this->settingsService->changePassword($request)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            Auth::logout();
            return redirect()->route('admin.login')->with('success', 'Password changed successfully. Please log in again.');
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }
}
