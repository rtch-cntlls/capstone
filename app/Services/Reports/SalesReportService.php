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
        $query = SaleItem::with('product', 'sale')
            ->whereHas('sale', function ($query) use ($from, $to) {
                $query->whereBetween(DB::raw('DATE(sale_date)'), [$from, $to]);
            });

        $items = $query->get()->groupBy('product_id')->map(function ($group) {
            $product = $group->first()->product;
            $totalSold = $group->sum('quantity');
            $totalSale = $group->sum('total');
            $avgPrice = $group->avg('price');

            $revenue = $group->sum(function ($item) {
                $cost = $item->product?->cost_price ?? 0;
                return ($item->price - $cost) * $item->quantity;
            });

            return [
                'product'      => $product,
                'total_sold'   => $totalSold,
                'total_sale'   => $totalSale,
                'avg_price'    => $avgPrice,
                'total_revenue'=> $revenue,
            ];
        })->sortByDesc('total_revenue');

        return $items->values();
    }

    public function exportCsv(string $from, string $to)
    {
        $productsSold = $this->getProductsSold($from, $to);

        $response = new StreamedResponse(function() use ($productsSold) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Product Name', 'Quantity Sold', 'Sale Price', 'Total Sale (₱)', 'Revenue (₱)']);
            foreach ($productsSold as $row) {
                fputcsv($handle, [
                    $row['product']->product_name ?? 'Unknown Product',
                    $row['total_sold'],
                    number_format($row['avg_price'], 2),
                    number_format($row['total_sale'], 2),
                    number_format($row['total_revenue'], 2),
                ]);
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
