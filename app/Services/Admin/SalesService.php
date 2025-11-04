<?php

namespace App\Services\Admin;

use App\Models\Sale;

class SalesService
{
    public function getSales(array $filters = [], int $perPage = 10)
    {
        $query = Sale::query();

        if (!empty($filters['sale_type']) && $filters['sale_type'] !== 'all') {
            $query->where('sale_type', $filters['sale_type']);
        }

        if (!empty($filters['transaction_date'])) {
            $query->whereDate('sale_date', $filters['transaction_date']);
        }

        return $query->orderBy('sale_date', 'desc')->paginate($perPage)->withQueryString();
    }

    public function getSaleById(int $saleId)
    {
        return Sale::with(['items.product', 'order.orderItems'])->findOrFail($saleId);
    }

    public function summaryCards(): array
    {
        $onlineSales = Sale::where('sale_type', 'online_order')->count();
        $walkinSales = Sale::where('sale_type', 'walk_in')->count();
        $totalSales  = Sale::count();

        return [
            [
                'title' => 'Total Sales', 'icon'  => 'fas fa-coins', 'value' => $totalSales,
                'type'  => 'transactions', 'color' => 'text-dark',
            ],
            [
                'title' => 'Walk-in Sales', 'icon'  => 'fas fa-store', 'value' => $walkinSales,
                'type'  => 'transactions', 'color' => 'text-success',
            ],
            [
                'title' => 'Online Orders', 'icon'  => 'fas fa-globe', 'value' => $onlineSales,
                'type'  => 'transactions', 'color' => 'text-primary',
            ],
        ];
    }
}
