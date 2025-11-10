<?php

namespace App\Services\Admin;

use App\Models\Customer;

class CustomerService
{
    public function getCustomersWithCards(int $perPage = 10): array
    {
        $customers = Customer::withTrashed()
            ->with(['user' => fn($q) => $q->withTrashed(), 'addresses', 'orders', 'bookings'])
            ->whereHas('orders')
            ->orWhereHas('bookings')
            ->paginate($perPage);
        
        $totalCustomers = Customer::withTrashed()
            ->whereHas('orders')
            ->orWhereHas('bookings')
            ->count();
    

        $cards = [
            [
                'title' => 'Total Customers',
                'value' => $totalCustomers,
                'type'  => 'customers',
                'icon' => 'fas fa-users',
                'color' => 'text-primary',
            ],
        ];

        return [$customers, $cards];
    }

    public function getCustomerPurchaseHistory(int $customerId)
    {
        $customer = Customer::withTrashed()
        ->with([
            'user' => fn($q) => $q->withTrashed(),
            'addresses',
            'bookings.service'
        ])
        ->findOrFail($customerId);

        $purchaseHistory = $customer->orders()->with('orderItems.product')
            ->whereIn('status', ['completed', 'cancelled'])
            ->latest()
            ->get();

        $bookings = $customer->bookings()->with('service')
            ->where('status', 'Completed')
            ->latest()
            ->get();

        return [$customer, $purchaseHistory, $bookings];
    }
}
