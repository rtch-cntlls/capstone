<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service; 
use App\Models\Booking; 
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ShopServicesController extends Controller
{
    public function index()
    {
        $shop = Shop::first();
        $services = Service::where('status', 'Active')->paginate(6);

        return view('client.pages.services.index', compact('services', 'shop'));
    }

    public function CreateBooking(Service $service)
    {
        $shop = Shop::first();
        if (!Auth::check() || Auth::user()->role_id != 2) {
            session(['booking_pending' => $service->service_id]);
    
            return redirect()->route('auth.customer.login');
        }
    
        return view('client.pages.services.create', compact('service', 'shop'));
    }

    public function StoreBooking(Request $request, Service $service)
    {
        $request->validate([
            'schedule' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $customerId = Auth::user()->customer->customer_id;

        $existingBooking = Booking::where('customer_id', $customerId)
            ->where('service_id', $service->service_id)
            ->whereIn('status', ['Pending', 'Approved', 'Rescheduled']) 
            ->first();

        if ($existingBooking) {
            return redirect()->route('mybooking.index')
                ->with('error', 'You already have an active booking for this service. Please complete or cancel it before booking again.');
        }

        Booking::create([
            'customer_id' => $customerId,
            'service_id'  => $service->service_id,
            'schedule'    => $request->schedule,
            'notes'       => $request->notes,
            'status'      => 'Pending',
        ]);

        return redirect()->route('mybooking.index')->with('success', 'Service booked successfully!');
    }
}
