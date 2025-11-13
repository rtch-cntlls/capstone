<?php

namespace App\Services\Reports;

use App\Models\Booking;
use App\Models\ServiceLog;
use PDF;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceReportService
{
    /**
     * Get bookings and logs (merged) with optional pagination
     */
    public function getBookingsAndLogs(?string $from, ?string $to, bool $paginate = false, int $perPage = 10)
    {
        $bookings = Booking::with(['customer.user', 'service'])
            ->where('status', 'completed')
            ->when($from && $to, fn($q) => $q->whereBetween('schedule', [$from, $to]))
            ->orderBy('schedule', 'asc')
            ->get();

        $logs = ServiceLog::with('service')
            ->when($from && $to, fn($q) => $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']))
            ->orderBy('created_at', 'asc')
            ->get();

        // Merge both collections and sort by date
        $merged = $bookings->concat($logs)->sortBy(function ($item) {
            return $item->schedule ?? $item->created_at;
        })->values(); // reindex keys

        if ($paginate) {
            $currentPage = request()->get('page', 1);
            $items = $merged->slice(($currentPage - 1) * $perPage, $perPage)->all();

            $paginated = new LengthAwarePaginator(
                $items,
                $merged->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return ['bookingsLogs' => $paginated, 'allItems' => $merged];
        }

        return ['bookingsLogs' => $merged, 'allItems' => $merged];
    }

    /**
     * Prepare daily trends for chart
     */
    public function getDailyTrends($merged)
    {
        $trends = [];
        foreach ($merged as $entry) {
            $date = date('Y-m-d', strtotime($entry->schedule ?? $entry->created_at));
            $trends[$date] = ($trends[$date] ?? 0) + 1;
        }
        ksort($trends);
        return $trends;
    }

    /**
     * Export PDF
     */
    public function exportPdf($merged, string $from, string $to)
    {
        $pdf = PDF::loadView('admin.pages.service-report.export-pdf', [
            'entries' => $merged,
            'from' => $from,
            'to' => $to
        ])->setPaper('a4', 'landscape');

        return $pdf->download("service_report_{$from}_to_{$to}.pdf");
    }

    /**
     * Export CSV
     */
    public function exportCsv($merged, string $from, string $to)
    {
        $filename = "service_report_{$from}_to_{$to}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['Date', 'Customer Name', 'Service', 'Type', 'Price'];

        $callback = function () use ($merged, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($merged as $entry) {
                $type = $entry instanceof \App\Models\Booking ? 'Booking' : 'Walk-in';
                $customerName = $type === 'Booking'
                    ? ($entry->customer && $entry->customer->user ? $entry->customer->user->firstname . ' ' . $entry->customer->user->lastname : 'N/A')
                    : ($entry->customer_name ?? 'N/A');

                fputcsv($file, [
                    date('Y-m-d', strtotime($entry->schedule ?? $entry->created_at)),
                    trim($customerName),
                    $entry->service->name ?? 'N/A',
                    $type,
                    $entry->service->price ?? 'N/A'
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
