<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Booking;
use App\Models\ServiceLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public const CUSTOMER_ROLE = 2;

    public function getDashboardData(int $month, int $year): array 
    {
        $today = Carbon::now();
        return [
            'currentDay'       => $today->day,
            'currentMonth'     => $today->month,
            'currentYear'      => $today->year,
            'month'            => $month,
            'year'             => $year,
            'startOfMonth'     => $this->getStartOfMonth($month, $year),
            'daysInMonth'      => $this->getDaysInMonth($month, $year),
            'cards'            => $this->getDashboardCards(),
            'recentProducts'   => $this->getRecentProducts(),
            'dailySales'       => $this->getDailySales(),
            'weeklySales'      => $this->getWeeklySales(),
            'overallRevenue'   => $this->getOverallRevenue(),
            'revenueBreakdown' => $this->getRevenueBreakdown(),
            'onlineVsWalkin'   => $this->getOnlineVsWalkin(), 
            'dailyServiceRevenue'    => $this->getDailyServiceRevenue(),
            'weeklyServiceRevenue'   => $this->getWeeklyServiceRevenue(),
            'lastWeekServiceRevenue' => $this->getLastWeekServiceRevenue(), 
        ];
    }

    private function getStartOfMonth(int $month, int $year): int
    {
        $firstDay = Carbon::create($year, $month, 1);
        return $firstDay->dayOfWeek;
    }

    private function getDaysInMonth(int $month, int $year): int
    {
        return Carbon::create($year, $month, 1)->daysInMonth;
    }

    private function getDashboardCards(): array
    {
        $totalProducts = Product::where('status', 'Active')->count();
    
        $totalUsers = User::where('role_id', DashboardService::CUSTOMER_ROLE)
            ->where(function ($query) {
                $query->whereHas('customer.orders')
                      ->orWhereHas('customer.bookings', function ($q) {
                          $q->where('status', 'Completed');
                      });
            })
            ->count();
    
        $totalOrder = OrderItem::with('product')->count();
        $totalBooking = Booking::with('service')->count();
    
        return [
            [
                'title' => 'Store Products',
                'value' => $totalProducts,
                'icon'  => 'fas fa-boxes bg-primary text-primary p-2 rounded bg-opacity-25',
            ],
            [
                'title' => 'Customer',
                'value' => $totalUsers,
                'icon'  => 'fas fa-user bg-success text-success p-2 rounded bg-opacity-25',
            ],
            [
                'title' => 'Order Items',
                'value' => $totalOrder, 
                'icon'  => 'fas fa-shopping-cart bg-info text-info p-2 rounded bg-opacity-25',
            ],
            [
                'title' => 'Booking',
                'value' => $totalBooking,
                'icon'  => 'fas fa-user bg-secondary text-secondary p-2 rounded bg-opacity-25',
            ],
        ];
    }    

    public function getTotalProductValue(): float
    {
        return Product::with('inventory')->get()
            ->sum(fn($product) => ($product->sale_price ?? 0) * ($product->inventory->instock ?? 0));
    }

    public function getTotalSoldProductValue(): float
    {
        return SaleItem::sum('total');
    }

    public function getTodaySalesTotal(): string
    {
        $today = now()->toDateString();

        $productSales = Sale::whereDate('sale_date', $today)
            ->sum('grand_total');

        $bookingRevenue = Booking::with('service')
            ->where('status', 'Completed')
            ->whereDate('created_at', $today)
            ->get()
            ->sum(fn($booking) => optional($booking->service)->price ?? 0);

        $serviceLogRevenue = ServiceLog::with('service')
            ->whereDate('created_at', $today)
            ->get()
            ->sum(fn($log) => optional($log->service)->price ?? 0);

        $total = $productSales + $bookingRevenue + $serviceLogRevenue;

        return $this->formatToK($total);
    }

    protected function formatToK(float $number): string
    {
        if ($number >= 1000000) {
            return rtrim(rtrim(number_format($number / 1000000, 1), '0'), '.') . 'M';
        } elseif ($number >= 1000) {
            return rtrim(rtrim(number_format($number / 1000, 1), '0'), '.') . 'K';
        }
    
        return rtrim(rtrim(number_format($number, 1), '0'), '.');
    }

    private function getRecentProducts()
    {
        return Product::with('category')->latest()->take(5)->get();
    }

    private function getWeeklySales(): float 
    {
        $today = Carbon::now();
        $weekStart = $today->copy()->startOfWeek();
        $weekEnd = $today->copy()->endOfWeek();
        
        return Sale::whereBetween('sale_date', [$weekStart, $weekEnd])
            ->sum('grand_total');
    }

    private function getDailySales()
    {
        $today = Carbon::now();
        $weekStart = $today->copy()->startOfWeek();
        $weekEnd = $today->copy()->endOfWeek();

        return Sale::select(
                DB::raw('DATE(sale_date) as date'),
                DB::raw('SUM(grand_total) as total')
            )
            ->whereBetween('sale_date', [$weekStart, $weekEnd])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');
    }

    public function getLastWeekSales(): float
    {
        $today = Carbon::now();
        $lastWeekStart = $today->copy()->subWeek()->startOfWeek();
        $lastWeekEnd = $today->copy()->subWeek()->endOfWeek();

        return Sale::whereBetween('sale_date', [$lastWeekStart, $lastWeekEnd])
            ->sum('grand_total');
    }

    public function getProductSalesShare(): array
    {
        $productSales = SaleItem::select(
                'product_id',
                DB::raw('SUM(total) as total_sales')
            )
            ->groupBy('product_id')
            ->with('product')
            ->get();
    
        $labels = [];
        $data = [];
        $topProducts = [];
    
        foreach ($productSales as $item) {
            if ($item->product) {
                $labels[] = $item->product->product_name;
                $data[] = round($item->total_sales, 2);
                $topProducts[] = [
                    'product_name' => $item->product->product_name,
                    'total' => round($item->total_sales, 2),
                ];
            }
        }
        return [
            'labels' => $labels,
            'data' => $data,
            'topProducts' => array_slice($topProducts, 0, 3), 
        ];
    }
    

    public function getOverallRevenue(?Carbon $month = null): array
    {
        $month = $month ?? Carbon::now();

        $productRevenue = Sale::whereMonth('created_at', $month->month)
                            ->whereYear('created_at', $month->year)
                            ->sum('grand_total');

        $bookingRevenue = Booking::with('service')
            ->where('status', 'Completed')
            ->whereMonth('created_at', $month->month)
            ->whereYear('created_at', $month->year)
            ->get()
            ->sum(fn($booking) => optional($booking->service)->price ?? 0);

        $serviceLogRevenue = ServiceLog::with('service')
            ->whereMonth('created_at', $month->month)
            ->whereYear('created_at', $month->year)
            ->get()
            ->sum(fn($log) => optional($log->service)->price ?? 0);

        $totalServiceRevenue = $bookingRevenue + $serviceLogRevenue;

        return [
            'productRevenue' => $productRevenue,
            'serviceRevenue' => $totalServiceRevenue,
            'totalRevenue'   => $productRevenue + $totalServiceRevenue,
        ];
    }

    public function getRevenueBreakdown(?Carbon $month = null): array
    {
        $revenues = $this->getOverallRevenue($month);

        return [
            'labels' => ['Products', 'Services'],
            'data'   => [
                round($revenues['productRevenue'], 2),
                round($revenues['serviceRevenue'], 2),
            ],
            'total'  => $revenues['totalRevenue'],
        ];
    }

    public function getOnlineVsWalkin(): array
    {
        $onlineSales = Sale::where('sale_type', 'online_order')->sum('grand_total');
        $walkinSales = Sale::where('sale_type', 'walk_in')->sum('grand_total');

        return [
            'labels' => ['Online Orders', 'Walk-in'],
            'data'   => [
                round($onlineSales, 2),
                round($walkinSales, 2),
            ],
            'total'  => $onlineSales + $walkinSales,
        ];
    }

    public function getWeeklyServiceRevenue(): float
    {
        $today = Carbon::now();
        $weekStart = $today->copy()->startOfWeek();
        $weekEnd   = $today->copy()->endOfWeek();

        $bookingRevenue = Booking::with('service')
            ->where('status', 'Completed')
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->get()
            ->sum(fn($booking) => optional($booking->service)->price ?? 0);

        $serviceLogRevenue = ServiceLog::with('service')
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->get()
            ->sum(fn($log) => optional($log->service)->price ?? 0);

        return $bookingRevenue + $serviceLogRevenue;
    }

    public function getDailyServiceRevenue()
    {
        $today = Carbon::now();
        $weekStart = $today->copy()->startOfWeek();
        $weekEnd   = $today->copy()->endOfWeek();
    
        $dailyRevenue = [];

        $bookings = Booking::with('service')
            ->where('status', 'Completed')
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->get();
    
        foreach ($bookings as $booking) {
            $date = $booking->created_at->toDateString();
            $dailyRevenue[$date] = ($dailyRevenue[$date] ?? 0) + (optional($booking->service)->price ?? 0);
        }

        $logs = ServiceLog::with('service')
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->get();
    
        foreach ($logs as $log) {
            $date = $log->created_at->toDateString();
            $dailyRevenue[$date] = ($dailyRevenue[$date] ?? 0) + (optional($log->service)->price ?? 0);
        }
    
        return collect($dailyRevenue);
    }    

    public function getLastWeekServiceRevenue(): float
    {
        $today = Carbon::now();
        $lastWeekStart = $today->copy()->subWeek()->startOfWeek();
        $lastWeekEnd   = $today->copy()->subWeek()->endOfWeek();

        $bookingRevenue = Booking::with('service')
            ->where('status', 'Completed')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->get()
            ->sum(fn($booking) => optional($booking->service)->price ?? 0);

        $serviceLogRevenue = ServiceLog::with('service')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->get()
            ->sum(fn($log) => optional($log->service)->price ?? 0);

        return $bookingRevenue + $serviceLogRevenue;
    }

    public function getMonthlyRevenueChart(): array
    {
        $revenues = Sale::select(
                DB::raw('MONTH(sale_date) as month'),
                DB::raw('SUM(grand_total) as total_revenue')
            )
            ->groupBy('month')
            ->pluck('total_revenue', 'month');

        $labels = [];
        $data = [];

        $maxRevenue = $revenues->max();
        $highestMonth = null;

        for ($m = 1; $m <= 12; $m++) {
            $labels[] = Carbon::create()->month($m)->format('M');
            $revenue = $revenues[$m] ?? 0;
            $data[] = round($revenue, 2);

            if ($revenue == $maxRevenue && $revenue > 0) {
                $highestMonth = Carbon::create()->month($m)->format('F');
            }
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'highestMonth' => $highestMonth ?? 'N/A',
            'highestRevenue' => round($maxRevenue ?? 0, 2),
        ];
    }
}
