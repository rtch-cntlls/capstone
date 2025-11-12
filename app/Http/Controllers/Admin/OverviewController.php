<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\OverviewService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OverviewController extends Controller
{
    protected $overviewService;

    public function __construct(OverviewService $overviewService)
    {
        $this->overviewService = $overviewService;
    }

    public function index(Request $request)
    {
        $month = (int) $request->input('month', Carbon::now()->month);
        $year  = (int) $request->input('year', Carbon::now()->year);
        $mode  = $request->input('mode', 'daily');

        $cards = $this->overviewService->getOverviewData();
        $salesTrends = $this->overviewService->getSalesTrends($month, $year, $mode);
        $revenueTrends = $this->overviewService->getRevenueTrends($month, $year, $mode);

        $topProducts = $this->overviewService->getTopProducts();
        $categoryRevenue = $this->overviewService->getCategoryRevenueShare();

        $recentSoldProducts = $this->overviewService->getRecentSoldProducts();

        return view('admin.pages.overview.index', compact(
            'cards', 'salesTrends', 'revenueTrends', 'month', 'year', 
            'mode', 'topProducts', 'categoryRevenue', 'recentSoldProducts' 
        ));
    }
}
