<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        try {
            $search = $request->input('search', null);
            [$customers, $cards] = $this->customerService->getCustomersWithCards(10, $search);
            return view('admin.pages.customer.index', compact('customers', 'cards'));
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function show($customerId)
    {
        try {
            [$customer, $purchaseHistory, $bookings] = $this->customerService->getCustomerPurchaseHistory($customerId);
            return view('admin.pages.customer.show', compact('customer', 'purchaseHistory', 'bookings'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }    
}
