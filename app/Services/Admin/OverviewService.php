<?php

namespace App\Services\Admin;

use App\Models\{Sale, SaleItem, Order};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OverviewService
{
    public function getOverviewData(): array
    {
        $periods = $this->getDatePeriods();

        $totalSales = Sale::sum('grand_total');
        $totalRevenue = $this->calculateRevenue();
        $totalOrders = Order::count();

        $thisPeriod = $this->getPeriodData($periods['this']);
        $lastPeriod = $this->getPeriodData($periods['last']);

        return $this->buildCards([
            'totalSales' => $totalSales,
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'this' => $thisPeriod,
            'last' => $lastPeriod,
        ]);
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
                'start' => $now->copy()->subDays(29)->startOfDay(),
                'end' => $now->copy()->endOfDay(),
            ],
            'last' => [
                'start' => $now->copy()->subDays(59)->startOfDay(),
                'end' => $now->copy()->subDays(30)->endOfDay(),
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
            'percent' => $previous == 0
                ? ($current > 0 ? 100 : 0)
                : round((($current - $previous) / $previous) * 100, 1),
        ];

        return [
            [
                'title' => 'Total Sales',
                'value' => $this->formatNumber($data['totalSales']),
                'type' => '₱',
                'growth' => $growth($data['this']['sales'], $data['last']['sales']),
            ],
            [
                'title' => 'Total Revenue',
                'value' => $this->formatNumber($data['totalRevenue']),
                'type' => '₱',
                'growth' => $growth($data['this']['revenue'], $data['last']['revenue']),
            ],
            [
                'title' => 'Total Orders',
                'value' => $data['totalOrders'],
                'type' => '',
                'growth' => $growth($data['this']['orders'], $data['last']['orders']),
            ],
        ];
    }

    public function getTopProducts(int $limit = 5): array
    {
        $topProducts = SaleItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take($limit)
            ->get();

        $labels = $topProducts->map(fn($item) => $item->product?->product_name ?? 'Unknown')->toArray();
        $data = $topProducts->pluck('total_quantity')->toArray();

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    public function getCategoryRevenueShare(): array
    {
        $categoryRevenue = SaleItem::with('product.category')
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

    public function getRecentSoldProducts(int $limit = 5)
    {
        $soldProducts = SaleItem::with('product.category')
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('AVG(price) as price'))
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
