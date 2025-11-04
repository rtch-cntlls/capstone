<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class MybookingController extends Controller
{
    public function index(Request $request)
    {
        $shop = Shop::first();
        $userId = Auth::id();
        $customer = Customer::where('user_id', $userId)->first();
    
        if (!$customer) {
            return redirect()->back()->with('error', 'No customer profile found.');
        }
    
        $status = $request->query('status');
    
        $query = Booking::with(['service'])
            ->where('customer_id', $customer->customer_id)
            ->orderBy('schedule', 'desc');
    
        if ($status) {
            $query->where('status', $status);
        } else {
            $query->whereIn('status', ['Pending', 'Rescheduled', 'Approved']);
        }
    
        $bookings = $query->paginate(9)->withQueryString();
    
        return view('client.pages.mybooking.index', compact('shop', 'bookings', 'status'));
    }
    
    public function cancel($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        if (in_array($booking->status, ['Pending', 'Rescheduled'])) {
            $booking->status = 'Cancelled';
            $booking->save();

            return back()->with('success', 'Your booking has been cancelled successfully.');
        }

        return back()->with('error', 'This booking cannot be cancelled.');
    }
}
