<?php

namespace App\Services\Admin;

use App\Models\ServiceLog;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ServiceLogService
{
    public function getLogs(array $filters = [], bool $paginate = true, int $perPage = 10)
    {
        $query = ServiceLog::with('service');

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

        return $paginate ? $query->latest()->paginate($perPage)->withQueryString() : $query->get();
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
                fputcsv($file, ['Customer Name','Contact Number','Service','Price','Date / Time']);
                foreach ($logs as $log) {
                    fputcsv($file, [
                        $log->customer_name,
                        $log->contact_number ?? '-',
                        $log->service->name ?? '-',
                        $log->service->price ?? '-',
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

    /**
     * Create a service log within a DB transaction
     */
    public function createLog(array $data): ServiceLog
    {
        return DB::transaction(function () use ($data) {
            return ServiceLog::create($data);
        });
    }
}
