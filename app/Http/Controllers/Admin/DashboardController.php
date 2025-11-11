<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\DashboardService;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService) {}

    public function index(Request $request): View|Response|RedirectResponse
    {
        try {
            $month = (int) $request->input('month', Carbon::now()->month);
            $year  = (int) $request->input('year', Carbon::now()->year);

            $data = $this->dashboardService->getDashboardData($month, $year);
            $data['totalProductValue'] = $this->dashboardService->getTotalProductValue();
            $data['todaySales'] = $this->dashboardService->getTodaySalesTotal();
            $data['soldProductValue'] = $this->dashboardService->getTotalSoldProductValue(); 

            $data['soldPercent'] = $data['totalProductValue'] > 0 
                ? round(($data['soldProductValue'] / $data['totalProductValue']) * 100, 1) 
                : 0;

            $data['productShare'] = $this->dashboardService->getProductSalesShare();

            $data['monthlyRevenueChart'] = $this->dashboardService->getMonthlyRevenueChart();
    
            return view('admin.pages.dashboard.index', $data);
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }
}
