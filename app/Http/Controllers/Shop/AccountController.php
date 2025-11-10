<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Address;
use App\Models\Customer;

class AccountController extends Controller
{
    public function show()
    {
        $shop = Shop::first();
        $user = Auth::user();
    
        $customer = Customer::where('user_id', $user->user_id)->with('addresses')->first();
    
        $address = $customer?->addresses->first();
    
        return view('client.pages.account.index', compact('shop', 'customer', 'address'));
    }

    public function privacy()
    {
        $shop = Shop::first();
        return view('client.pages.account.settings', compact('shop'));
    }

    public function deleteAccount()
    {
        $user = Auth::user();
        $customer = $user->customer;
    
        if ($customer) {
            $pendingOrders = $customer->orders()->whereNotIn('status', ['completed', 'cancelled'])->exists();
            $pendingBookings = $customer->bookings()->whereNotIn('status', ['Completed', 'Cancelled', 'Failed'])->exists();
    
            if ($pendingOrders || $pendingBookings) {
                return back()->with('error', 'You cannot delete your account while you have active orders or bookings.');
            }
            $customer->update(['phone' => null]);
            $customer->delete();
        }
    
        $user->update([
            'email' => 'deleted_user_' . $user->user_id . '@example.com',
            'firstname' => 'Deleted',
            'lastname' => 'Account',
            'password' => 'delete',
        ]);
    
        Auth::logout();
        $user->delete();
    
        return redirect('/')->with('success', 'Account deleted successfully.');
    }    

    public function updateProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . auth()->id() . ',user_id',
            'phone'     => 'nullable|string|max:20',
        ]);

        $user = auth()->user();
        $user->update([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
        ]);

        if ($user->customer) {
            $user->customer->update([
                'phone' => $request->phone,
            ]);
        } else {
            $user->customer()->create([
                'phone' => $request->phone,
            ]);
        }

        return back()->with('success', 'Profile updated successfully!');
    }

    public function storeAddress(Request $request)
    {
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->user_id)->first();
        $shop = Shop::first();
    
        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);
    
        if ($shop->service_area === 'province' && $validated['province'] !== $shop->province) {
            return back()->with('error', 'This address is not supported by this shop.');
        }
    
        if ($shop->service_area === 'local' &&
            ($validated['province'] !== $shop->province || $validated['city'] !== $shop->city)) {
            return back()->with('error', 'This address is not supported by this shop.');
        }
    
        if ($customer->addresses()->exists()) {
            $customer->addresses()->delete();
        }

        Address::create([
            'customer_id' => $customer->customer_id,
            'street' => $validated['street'],
            'barangay' => $validated['barangay'],
            'city' => $validated['city'] ?? $shop->city,
            'province' => $validated['province'] ?? $shop->province,
            'postal_code' => $validated['postal_code'],
        ]);
    
        return back()->with('success', 'Address saved successfully!');
    }    
}
