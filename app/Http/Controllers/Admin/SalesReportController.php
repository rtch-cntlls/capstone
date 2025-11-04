<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Services\Reports\SalesReportService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    protected $salesReportService;

    public function __construct(SalesReportService $salesReportService)
    {
        $this->salesReportService = $salesReportService;
    }

    public function index(Request $request)
    {
        $from = $request->input('from', Carbon::now()->startOfMonth()->toDateString());
        $to = $request->input('to', Carbon::now()->endOfMonth()->toDateString());

        $sales = Sale::whereBetween(DB::raw('DATE(sale_date)'), [$from, $to])
            ->select(
                DB::raw('DATE(sale_date) as date'),
                DB::raw('COUNT(sale_id) as order_count'),
                DB::raw('SUM(grand_total) as sales'),
                DB::raw('AVG(grand_total) as avg_order_value')
            )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $productsSold = $this->salesReportService->getProductsSold($from, $to)
            ->through(function ($item) {
                return [
                    'name' => $item->product->product_name ?? 'Unknown Product',
                    'total_sold' => $item->total_sold,
                    'total_revenue' => $item->total_revenue,
                    'avg_price' => $item->avg_price,
                ];
            });        

        return view('admin.pages.sale-report.index', compact('sales', 'from', 'to', 'productsSold'));
    }

    public function exportCsv(Request $request)
    {
        return $this->salesReportService->exportCsv($request->input('from'), $request->input('to'));
    }

    public function exportPdf(Request $request)
    {
        return $this->salesReportService->exportPdf($request->input('from'), $request->input('to'));
    }
}
