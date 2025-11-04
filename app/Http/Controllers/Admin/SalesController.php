<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Services\Admin\SalesService;
use PDF;
use Illuminate\Support\Facades\Response;
use App\Models\Sale;

class SalesController extends Controller
{
    protected SalesService $salesService;

    public function __construct(SalesService $salesService)
    {
        $this->salesService = $salesService;
    }

    public function index(Request $request)
    {
        try {
            $shop = Shop::first();
            $filters = [
                'sale_type' => $request->sale_type,
                'transaction_date' => $request->transaction_date,
            ];
    
            $sales = $this->salesService->getSales($filters);
            $cards = $this->salesService->summaryCards();
    
            return view('admin.pages.sales.index', compact('sales', 'shop', 'cards'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function SaleShow($sale_id)
    {
        try {
            $sale = $this->salesService->getSaleById($sale_id);
            return view('admin.pages.sales.show', compact('sale'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function exportPdf(Request $request)
    {
        $saleType = $request->input('sale_type', 'all');

        $query = Sale::with(['items.product']);
        if ($saleType !== 'all') {
            $query->where('sale_type', $saleType);
        }

        $sales = $query->orderBy('sale_date', 'desc')->get();

        $pdf = PDF::loadView('admin.pages.sales.export-pdf', compact('sales', 'saleType'))
            ->setPaper('a4', 'landscape');

        $filename = "sales_report_{$saleType}_" . now()->format('Y-m-d') . ".pdf";
        return $pdf->download($filename);
    }

    public function exportCsv(Request $request)
    {
        $saleType = $request->input('sale_type', 'all');

        $query = Sale::with(['items.product']);
        if ($saleType !== 'all') {
            $query->where('sale_type', $saleType);
        }

        $sales = $query->orderBy('sale_date', 'desc')->get();

        $filename = "sales_report_{$saleType}_" . now()->format('Y-m-d') . ".csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () use ($sales) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Sale Type',
                'Sale Date',
                'Amount Pay',
                'Change',
                'Grand Total',
                'Product ID',
                'Quantity',
                'Price',
                'Discount',
                'Total',
            ]);

            foreach ($sales as $sale) {
                foreach ($sale->items as $item) {
                    fputcsv($file, [
                        ucfirst(str_replace('_', ' ', $sale->sale_type)),
                        optional($sale->sale_date)->format('Y-m-d H:i'),
                        $sale->amount_pay,
                        $sale->change,
                        $sale->grand_total,
                        $item->product->product_name,
                        $item->quantity,
                        $item->price,
                        $item->discount,
                        $item->total,
                    ]);
                }
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
