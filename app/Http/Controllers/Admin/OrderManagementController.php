<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\OrderService;

class OrderManagementController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        try {
            [$orders, $cards] = $this->orderService->getOrdersAndCards($request);

            $localOrders = $orders->where('order_type', 'local');
            $nationwideOrders = $orders->where('order_type', 'nationwide');

            return view('admin.pages.order.index', compact('orders', 'cards', 'localOrders', 'nationwideOrders'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function show($orderId)
    {
        try {
            $productOrder = $this->orderService->getOrderById($orderId);

            return view('admin.pages.order.show', compact('productOrder'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function updateStatus(Request $request, $orderId)
    {
        
        $request->validate([
            'status' => 'required|in:pending,processing,out_for_delivery,completed,cancelled,ready_for_pick_up,shipped',
            'estimated_date' => 'nullable|date', 
            'courier' => 'nullable|string|max:100',
            'tracking_number' => 'nullable|string|max:100', 
            'expected_delivery_date' => 'nullable|date', 
        ]);
    
        try {
            $this->orderService->updateStatus(
                $orderId, $request->status, 
                $request->estimated_date,
                $request->courier, 
                $request->tracking_number,
                $request->expected_delivery_date
            );    
    
            return redirect()->back()->with('success-alert', 'Order status updated!');
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }
}
