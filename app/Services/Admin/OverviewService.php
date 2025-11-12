<?php

namespace App\Services\Admin;

use App\Models\{Sale, SaleItem, Order};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OverviewService
{
    public function getOverviewData(): array
    {
        $now = Carbon::now();

        $thisMonthPeriod = [
            'start' => $now->copy()->startOfMonth(),
            'end' => $now->copy()->endOfMonth(),
        ];

        $lastMonthPeriod = [
            'start' => $now->copy()->subMonth()->startOfMonth(),
            'end' => $now->copy()->subMonth()->endOfMonth(),
        ];

        $thisMonthData = $this->getPeriodData($thisMonthPeriod);
        $lastMonthData = $this->getPeriodData($lastMonthPeriod);
    
        return $this->buildCards([
            'this' => $thisMonthData,
            'last' => $lastMonthData,
        ]);
    }
    
    public function getRevenueTrends(int $month, int $year, string $mode = 'daily'): array
    {
        $labels = [];
        $data = [];

        switch ($mode) {
            case 'daily':
                $items = SaleItem::with('product')
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get()
                    ->groupBy(fn($item) => $item->created_at->day);

                $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $labels[] = $day;
                    $data[] = isset($items[$day])
                        ? $items[$day]->sum(fn($i) => ($i->price - ($i->product?->cost_price ?? 0)) * $i->quantity)
                        : 0;
                }
                break;

        }

        return ['labels' => $labels, 'data' => $data];
    }

    public function getSalesTrends(int $month, int $year, string $mode = 'daily'): array
    {
        $labels = [];
        $data = [];

        switch ($mode) {
            case 'daily':
                $sales = Sale::select(
                        DB::raw('DAY(sale_date) as day'),
                        DB::raw('SUM(grand_total) as total')
                    )
                    ->whereYear('sale_date', $year)
                    ->whereMonth('sale_date', $month)
                    ->groupBy('day')
                    ->orderBy('day')
                    ->pluck('total', 'day');

                $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $labels[] = $day;
                    $data[] = $sales[$day] ?? 0;
                }
                break;

            case 'monthly':
                $sales = Sale::select(
                        DB::raw('MONTH(sale_date) as month'),
                        DB::raw('SUM(grand_total) as total')
                    )
                    ->whereYear('sale_date', $year)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month');

                for ($m = 1; $m <= 12; $m++) {
                    $labels[] = Carbon::create()->month($m)->format('M');
                    $data[] = $sales[$m] ?? 0;
                }
                break;

            case 'yearly':
                $sales = Sale::select(
                        DB::raw('YEAR(sale_date) as year'),
                        DB::raw('SUM(grand_total) as total')
                    )
                    ->groupBy('year')
                    ->orderBy('year')
                    ->pluck('total', 'year');

                $years = Sale::select(DB::raw('YEAR(sale_date) as year'))
                    ->distinct()
                    ->pluck('year');

                foreach ($years as $y) {
                    $labels[] = $y;
                    $data[] = $sales[$y] ?? 0;
                }
                break;
        }

        return [
            'labels' => $labels,
            'data'   => $data,
        ];
    }

    private function getDatePeriods(): array
    {
        $now = Carbon::now();
    
        return [
            'this' => [
                'start' => $now->copy()->startOfMonth(),
                'end' => $now->copy()->endOfMonth(),
            ],
            'last' => [
                'start' => $now->copy()->subMonth()->startOfMonth(),
                'end' => $now->copy()->subMonth()->endOfMonth(),
            ],
        ];
    }    

    private function getPeriodData(array $period): array
    {
        return [
            'sales' => Sale::whereBetween('created_at', [$period['start'], $period['end']])
                ->sum('grand_total'),
            'revenue' => $this->calculateRevenue($period['start'], $period['end']),
            'orders' => Order::whereBetween('created_at', [$period['start'], $period['end']])
                ->count(),
        ];
    }

    private function calculateRevenue(?Carbon $start = null, ?Carbon $end = null): float
    {
        $query = SaleItem::with('product');
        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }

        return $query->get()->sum(function ($item) {
            $cost = $item->product?->cost_price ?? 0;
            return ($item->price - $cost) * $item->quantity;
        });
    }

    private function formatNumber(float $number): string
    {
        if ($number >= 1_000_000) {
            return number_format($number / 1_000_000, 1) . 'M';
        }

        if ($number >= 1_000) {
            return number_format($number / 1_000, 1) . 'K';
        }

        return number_format($number, 2);
    }

    private function buildCards(array $data): array 
    {
        $growth = fn($current, $previous) => [
            'difference' => $current - $previous,
            'percent' => min(
                $previous == 0
                    ? ($current > 0 ? 100 : 0)
                    : round((($current - $previous) / $previous) * 100, 1),
                100 
            ),
        ];

        return [
            [
                'title' => 'Total Sales',
                'value' => $this->formatNumber($data['this']['sales']),
                'type' => '₱',
                'growth' => $growth($data['this']['sales'], $data['last']['sales']),
            ],
            [
                'title' => 'Total Revenue',
                'value' => $this->formatNumber($data['this']['revenue']),
                'type' => '₱',
                'growth' => $growth($data['this']['revenue'], $data['last']['revenue']),
            ],
            [
                'title' => 'Total Orders',
                'value' => $data['this']['orders'],
                'type' => '',
                'growth' => $growth($data['this']['orders'], $data['last']['orders']),
            ],
        ];
    }
    

    public function getTopProducts(int $limit = 5, ?int $month = null, ?int $year = null): array
    {
        $month = $month ?? now()->month;
        $year  = $year ?? now()->year;
    
        $topProducts = SaleItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->with('product')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take($limit)
            ->get();
    
        $labels = $topProducts->map(fn($item) => $item->product?->product_name ?? 'Unknown')->toArray();
        $data   = $topProducts->pluck('total_quantity')->toArray();
    
        return [
            'labels' => $labels,
            'data'   => $data,
        ];
    }
    
    public function getCategoryRevenueShare(?int $month = null, ?int $year = null): array
    {
        $month = $month ?? now()->month;
        $year  = $year ?? now()->year;
    
        $categoryRevenue = SaleItem::with('product.category')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get()
            ->groupBy(fn($item) => $item->product?->category?->name ?? 'Uncategorized')
            ->map(fn($items) => $items->sum(function ($item) {
                $cost = $item->product?->cost_price ?? 0;
                return ($item->price - $cost) * $item->quantity;
            }));
    
        return [
            'labels' => $categoryRevenue->keys()->toArray(),
            'data'   => $categoryRevenue->values()->toArray(),
        ];
    }    

    public function getRecentSoldProducts(int $limit = 5, ?int $month = null, ?int $year = null)
    {
        $month = $month ?? now()->month;
        $year  = $year ?? now()->year;
    
        $soldProducts = SaleItem::with('product.category')
            ->select(
                'product_id',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('AVG(price) as price')
            )
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('product_id')
            ->orderByDesc(DB::raw('SUM(quantity)'))
            ->take($limit)
            ->get();
    
        foreach ($soldProducts as $item) {
            $cost = $item->product?->cost_price ?? 0;
            $item->total_revenue = ($item->price - $cost) * $item->total_quantity;
        }
    
        return $soldProducts;
    }    
}
