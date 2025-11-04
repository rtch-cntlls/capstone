<?php

namespace App\Services\Admin;

use App\Models\Customer;

class CustomerService
{
    public function getCustomersWithCards(int $perPage = 10): array
    {
        $customers = Customer::with(['user', 'addresses', 'motorcycles', 'orders'])
            ->whereHas('orders')
            ->paginate($perPage);

        $totalCustomers = Customer::whereHas('orders')->count();

        $cards = [
            [
                'title' => 'Total Customers', 'value' => $totalCustomers, 'type'  => 'customers',
                'icon' => 'fas fa-users', 'color' => 'text-primary',
            ],
        ];

        return [$customers, $cards];
    }

    public function getCustomerPurchaseHistory(int $customerId)
    {
        $customer = Customer::with(['user', 'addresses'])->findOrFail($customerId);

        $purchaseHistory = $customer->orders()->with('orderItems.product')
            ->whereIn('status', ['completed', 'cancelled'])->latest()->get();

        return [$customer, $purchaseHistory];
    }
}
