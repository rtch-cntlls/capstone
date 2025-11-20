<?php

namespace App\Services\Admin;

use App\Models\ServiceLog;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceLogService
{
    public function getLogs(array $filters = [], bool $paginate = true, int $perPage = 10)
    {
        $query = ServiceLog::with(['service']);

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(fn($q) => $q->where('customer_name', 'like', "%{$search}%")
                                      ->orWhere('contact_number', 'like', "%{$search}%"));
        }

        if (!empty($filters['service_id'])) {
            $query->where('service_id', $filters['service_id']);
        }

        if (!empty($filters['from']) && !empty($filters['to'])) {
            $query->whereDate('created_at', '>=', $filters['from'])
                  ->whereDate('created_at', '<=', $filters['to']);
        }

        $allLogs = $query
            ->orderByDesc('service_date')
            ->orderByDesc('created_at')
            ->get();

        $grouped = $allLogs
            ->groupBy(function (ServiceLog $log) {
                return $log->customer_name;
            })
            ->map->first()
            ->values();

        if (!$paginate) {
            return $grouped;
        }

        $page = request()->get('page', 1);
        $page = (int) ($page ?: 1);

        $items = $grouped->forPage($page, $perPage)->values();

        return new LengthAwarePaginator(
            $items,
            $grouped->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function getActiveServices()
    {
        return Service::where('status', 'Active')->get();
    }

    public function exportCsv($logs)
    {
        $filename = 'service_logs_' . now()->format('Ymd_His') . '.csv';
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            if ($logs->isNotEmpty()) {
                fputcsv($file, ['Customer Name','Contact Number','Service','Date / Time']);
                foreach ($logs as $log) {
                    fputcsv($file, [
                        $log->customer_name,
                        $log->contact_number ?? '-',
                        optional($log->service)->name ?? '-',
                        $log->created_at->format('M. d, Y h:i A'),
                    ]);
                }
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf($logs)
    {
        $pdf = Pdf::loadView('admin.pages.service-log.export-pdf', ['logs' => $logs]);
        return $pdf->download('service_logs_' . now()->format('Ymd_His') . '.pdf');
    }

    public function createLog(array $data): ServiceLog
    {
        return DB::transaction(function () use ($data) {
            return ServiceLog::create($data);
        });
    }
}
