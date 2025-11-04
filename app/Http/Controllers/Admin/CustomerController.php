<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CustomerService;

class CustomerController extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        try {
            [$customers, $cards] = $this->customerService->getCustomersWithCards();

            return view('admin.pages.customer.index', compact('customers', 'cards'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function show($customerId)
    {
        try {
            [$customer, $purchaseHistory] = $this->customerService->getCustomerPurchaseHistory($customerId);

            return view('admin.pages.customer.show', compact('customer', 'purchaseHistory'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }
}
