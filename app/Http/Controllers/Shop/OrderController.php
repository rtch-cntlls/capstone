<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Services\Shop\OrderService; 
use App\Models\Shop;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $shop = Shop::first();
        $status = $request->query('status');

        $orders = $this->orderService->getCustomerOrders(10, $status);
        $counts = $this->orderService->getOrderCounts();

        return view('client.pages.myorder.index', compact('orders', 'shop', 'status', 'counts'));
    }

    public function show($order_id)
    {
        $shop = Shop::first();
        $order = $this->orderService->getCustomerOrder($order_id);

        return view('client.pages.myorder.show', compact('order', 'shop'));
    }

    public function cancel($orderId)
    {
        $this->orderService->cancelCustomerOrder($orderId);
    
        return redirect()
            ->route('order.index')
            ->with('success', 'Your order has been successfully cancelled.');
    }
}
