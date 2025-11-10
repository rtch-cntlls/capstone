<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Wishlist;
use App\Models\Booking;
use App\Models\Motorcycle;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\Message;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartCount = 0;
            $wishlistCount = 0;
            $bookingCount = 0;
            $garageCount = 0;
            $orderCount = 0;
    
            $notifications = [
                'newOrders' => 0,
                'newBookings' => 0,
            ];
    
            if (Auth::check()) {
                if (Auth::user()->role_id == 2) {
                    $customer = Customer::where('user_id', Auth::id())->first();
    
                    if ($customer) {
                        $cartCount = Cart::where('customer_id', $customer->customer_id)->count();
                        $wishlistCount = Wishlist::where('customer_id', $customer->customer_id)->count();
                        $bookingCount = Booking::where('customer_id', $customer->customer_id)
                            ->whereIn('status', ['pending', 'approved'])
                            ->count();
                        $garageCount = Motorcycle::where('customer_id', $customer->customer_id)->count();
                        $orderCount = Order::where('customer_id', $customer->customer_id)
                            ->whereIn('status', ['pending', 'processing', 'out_for_delivery', 'shipped', 'ready_for_pick_up'])
                            ->count();
                    }
                }
    
                if (Auth::user()->role_id == 1) {
                    $today = now()->startOfDay();
    
                    $notifications['newOrders'] = Order::whereDate('created_at', $today)->whereIn('status', ['pending'])->count();
                    $notifications['newBookings'] = Booking::whereDate('created_at', $today)->whereIn('status', ['pending'])->count();
                    $notifications['newReviews'] = ProductReview::whereDate('created_at', $today)->count();
                    $notifications['reviewedProducts'] = ProductReview::with('product:product_id,product_name')
                    ->whereDate('created_at', $today)
                    ->selectRaw('product_id, COUNT(*) as review_count')
                    ->groupBy('product_id')
                    ->get();

                    $notifications['newMessages'] = Message::where('receiver_id', Auth::id())
                    ->whereNull('read_at')
                    ->where('admin_replied', false)
                    ->count();
                }
            }
    
            $view->with([
                'cartCount' => $cartCount,
                'wishlistCount' => $wishlistCount,
                'bookingCount' => $bookingCount,
                'garageCount' => $garageCount,
                'orderCount' => $orderCount,
                'notifications' => $notifications,
            ]);
        });
    }
    
}
