<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ServiceLogService;

class ServiceLogController extends Controller
{
    protected $service;

    public function __construct(ServiceLogService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'service_id', 'from', 'to', 'export']);

        if (!empty($filters['export'])) {
            $logs = $this->service->getLogs($filters, false);
            return match($filters['export']) {
                'csv' => $this->service->exportCsv($logs),
                'pdf' => $this->service->exportPdf($logs),
                default => abort(404),
            };
        }

        $logs = $this->service->getLogs($filters);
        $services = $this->service->getActiveServices();
        $from = $filters['from'] ?? null;
        $to = $filters['to'] ?? null;

        return view('admin.pages.service-log.index', compact('logs', 'services', 'from', 'to'));
    }

    public function create()
    {
        $services = $this->service->getActiveServices();
        return view('admin.pages.service-log.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'service_id' => 'required|exists:services,service_id',
        ], [
            'service_id.required' => 'Please select a service type.',
            'service_id.exists' => 'Selected service does not exist.',
        ]);

        $this->service->createLog($request->only('customer_name', 'contact_number', 'service_id'));

        return redirect()->route('admin.service-logs.index')
                         ->with('success', 'Service logged successfully.');
    }
}
