<?php

namespace App\Services\Reports;

use App\Models\Booking;
use PDF;
use Illuminate\Support\Facades\Response;

class ServiceReportService
{
    public function getBookings(?string $from, ?string $to, bool $paginate = false, int $perPage = 10)
    {
        $query = Booking::with(['customer.user', 'service'])
            ->where('status', 'completed');

        if ($from && $to) {
            $query->whereBetween('schedule', [$from, $to]);
        }

        $query->orderBy('schedule', 'asc');

        return $paginate ? $query->paginate($perPage)->withQueryString() : $query->get();
    }

    public function getDailyTrends($bookings): array
    {
        $trends = [];

        foreach ($bookings as $b) {
            $date = date('Y-m-d', strtotime($b->schedule));
            if (!isset($trends[$date])) {
                $trends[$date] = 0;
            }
            $trends[$date]++;
        }

        ksort($trends);

        return $trends;
    }

    public function exportPdf($bookings, string $from, string $to)
    {
        $pdf = PDF::loadView('admin.pages.service-report.export-pdf', [
            'bookings' => $bookings,
            'from' => $from,
            'to' => $to
        ])->setPaper('a4', 'landscape');

        return $pdf->download("service_report_{$from}_to_{$to}.pdf");
    }

    public function exportCsv($bookings, string $from, string $to)
    {
        $filename = "service_report_{$from}_to_{$to}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['Date', 'Customer Name', 'Motorcycle / Service', 'Status'];

        $callback = function () use ($bookings, $columns) {
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
                    ucfirst($b->status ?? 'N/A')
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
