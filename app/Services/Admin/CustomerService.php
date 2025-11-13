<?php

namespace App\Services\Admin;

use App\Models\Customer;

class CustomerService
{
    public function getCustomersWithCards(int $perPage = 10, ?string $search = null): array
    {
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();
    
        $lastMonthStart = now()->subMonth()->startOfMonth();
        $lastMonthEnd = now()->subMonth()->endOfMonth();

        $query = Customer::withTrashed()
            ->with([
                'user' => fn($q) => $q->withTrashed(),
                'addresses',
                'orders' => fn($q) => $q->where('status', 'completed'),
                'bookings' => fn($q) => $q->where('status', 'Completed'),
            ])
            ->where(function ($q) {
                $q->whereHas('orders', fn($q) => $q->where('status', 'completed'))
                  ->orWhereHas('bookings', fn($q) => $q->where('status', 'Completed'));
            });
    
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%");
            });
        }
    
        $customers = $query->paginate($perPage)->withQueryString();
        $totalCustomersThisMonth = Customer::withTrashed()
            ->where(function ($q) use ($monthStart, $monthEnd) {
                $q->whereHas('orders', fn($q) => $q->where('status', 'completed')
                    ->whereBetween('created_at', [$monthStart, $monthEnd]))
                  ->orWhereHas('bookings', fn($q) => $q->where('status', 'Completed')
                    ->whereBetween('created_at', [$monthStart, $monthEnd]));
            })
            ->count();
    
        $totalCustomersLastMonth = Customer::withTrashed()
            ->where(function ($q) use ($lastMonthStart, $lastMonthEnd) {
                $q->whereHas('orders', fn($q) => $q->where('status', 'completed')
                    ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd]))
                  ->orWhereHas('bookings', fn($q) => $q->where('status', 'Completed')
                    ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd]));
            })
            ->count();

        if ($totalCustomersLastMonth > 0) {
            $growthRate = (($totalCustomersThisMonth - $totalCustomersLastMonth) / $totalCustomersLastMonth) * 100;
        } else {
            $growthRate = $totalCustomersThisMonth > 0 ? 100 : 0;
        }
    
        $cards = [
            [
                'title' => 'Total Customers This Month',
                'value' => $totalCustomersThisMonth,
                'type'  => 'Last month: ' . $totalCustomersLastMonth,
                'growth' => round($growthRate, 1),
                'icon'  => 'fas fa-users',
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
