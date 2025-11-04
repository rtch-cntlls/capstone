<?php

namespace App\Services\Reports;

use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PDF;

class SalesReportService
{
    public function getProductsSold(string $from, string $to)
    {
        return SaleItem::with('product', 'sale')
            ->whereHas('sale', function ($query) use ($from, $to) {
                $query->whereBetween(DB::raw('DATE(sale_date)'), [$from, $to]);
            })
            ->select(
                'product_id',
                DB::raw('SUM(quantity) as total_sold'),
                DB::raw('SUM(total) as total_revenue'),
                DB::raw('AVG(price) as avg_price')
            )
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->paginate(10);
    }       

    public function exportCsv(string $from, string $to)
    {
        $productsSold = $this->getProductsSold($from, $to)
            ->map(function ($item) {
                return [
                    'Product Name' => $item->product->product_name ?? 'Unknown Product',
                    'Quantity Sold' => $item->total_sold,
                    'Sale Price' => number_format($item->avg_price, 2),
                    'Total' => number_format($item->total_revenue, 2),
                ];
            });

        $response = new StreamedResponse(function() use ($productsSold) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Product Name', 'Quantity Sold', 'Sale Price', 'Total']);
            foreach ($productsSold as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        });

        $filename = 'products_sold_' . $from . '_to_' . $to . '.csv';
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', "attachment; filename={$filename}");

        return $response;
    }

    public function exportPdf(string $from, string $to)
    {
        $productsSold = $this->getProductsSold($from, $to);

        $pdf = PDF::loadView('admin.pages.sale-report.export-pdf', [
            'productsSold' => $productsSold,
            'from' => $from,
            'to' => $to,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('products_sold_' . $from . '_to_' . $to . '.pdf');
    }
}
