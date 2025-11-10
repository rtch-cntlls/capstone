<?php

namespace App\Services\Reports;

use App\Models\Booking;
use App\Models\ServiceLog;
use PDF;
use Illuminate\Support\Facades\Response;

class ServiceReportService
{
    public function getBookingsAndLogs(?string $from, ?string $to, bool $paginate = false, int $perPage = 10)
    {
        $bookingQuery = Booking::with(['customer.user', 'service'])
            ->where('status', 'completed');

        if ($from && $to) {
            $bookingQuery->whereBetween('schedule', [$from, $to]);
        }

        $bookingQuery->orderBy('schedule', 'asc');

        $bookings = $paginate 
            ? $bookingQuery->paginate($perPage)->withQueryString() 
            : $bookingQuery->get();

        $logQuery = ServiceLog::with('service');

        if ($from && $to) {
            $logQuery->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
        }

        $logQuery->orderBy('created_at', 'asc');

        $logs = $paginate 
            ? $logQuery->paginate($perPage)->withQueryString() 
            : $logQuery->get();

        if ($paginate) {
            return ['bookings' => $bookings, 'logs' => $logs];
        }

        return ['bookings' => $bookings, 'logs' => $logs];
    }

    public function getDailyTrends($bookings, $logs): array
    {
        $trends = [];

        foreach ($bookings as $b) {
            $date = date('Y-m-d', strtotime($b->schedule));
            $trends[$date] = ($trends[$date] ?? 0) + 1;
        }

        foreach ($logs as $l) {
            $date = date('Y-m-d', strtotime($l->created_at));
            $trends[$date] = ($trends[$date] ?? 0) + 1;
        }

        ksort($trends);
        return $trends;
    }

    public function exportPdf($bookings, $logs, string $from, string $to)
    {
        $pdf = PDF::loadView('admin.pages.service-report.export-pdf', [
            'bookings' => $bookings,
            'logs' => $logs,
            'from' => $from,
            'to' => $to
        ])->setPaper('a4', 'landscape');

        return $pdf->download("service_report_{$from}_to_{$to}.pdf");
    }

    public function exportCsv($bookings, $logs, string $from, string $to)
    {
        $filename = "service_report_{$from}_to_{$to}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['Date', 'Customer Name', 'Service', 'Type', 'Price'];

        $callback = function () use ($bookings, $logs, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $b) {
                $customerName = ($b->customer && $b->customer->user)
                    ? $b->customer->user->firstname . ' ' . $b->customer->user->lastname
                    : 'N/A';

                fputcsv($file, [
                    date('Y-m-d', strtotime($b->schedule)),
                    trim($customerName),
                    $b->service->name ?? 'N/A',
                    'Booking',
                    $b->service->price ?? 'N/A'
                ]);
            }

            foreach ($logs as $l) {
                fputcsv($file, [
                    date('Y-m-d', strtotime($l->created_at)),
                    $l->customer_name ?? 'N/A',
                    $l->service->name ?? 'N/A',
                    'Walk-in',
                    $l->service->price ?? 'N/A'
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
