<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ServiceLogService;
use App\Models\ServiceLog;
use App\Models\Service;
use App\Services\Admin\ServiceLogPredictionService;

class ServiceLogController extends Controller
{
    protected $service;

    public function __construct(ServiceLogService $service)
    {
        $this->service = $service;
    }

    public function refreshPrediction(ServiceLog $log, ServiceLogPredictionService $predictionService)
    {
        $result = $predictionService->predict($log);
        if ($result) {
            return back()->with('success', 'AI prediction refreshed.');
        }
        return back()->with('warning', 'AI prediction unavailable. Please try again later.');
    }

    public function updateGmail(Request $request, ServiceLog $serviceLog)
    {
        $data = $request->validate([
            'gmail' => 'nullable|email|max:255',
            'customer_name' => 'nullable|string|max:255',
        ]);

        if (!empty($data['customer_name'])) {
            $serviceLog->update(['customer_name' => $data['customer_name']]);
        }

        ServiceLog::where('customer_name', $serviceLog->customer_name)
            ->update(['gmail' => $data['gmail'] ?? null]);

        return back()->with('success', 'Customer details updated.');
    }
    
    protected function getMotorcycleBrands()
    {
        $brands = [];
        $path = public_path('motorcycle/MotorcycleData.json');
        
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $brands = json_decode($json, true) ?? [];
        }
        
        return $brands;
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

        $brands = $this->getMotorcycleBrands();

        view()->share('brands', $brands);

        return view('admin.pages.service-log.index', compact('logs', 'services', 'from', 'to', 'brands'));
    }

    public function create()
    {
        $services = $this->service->getActiveServices();

        $brands = [];
        $path = public_path('motorcycle/MotorcycleData.json');
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $brands = json_decode($json, true) ?? [];
        }

        return view('admin.pages.service-log.create', compact('services', 'brands'));
    }

    public function store(Request $request, ServiceLogPredictionService $predictionService)
    {
        $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'gmail' => 'nullable|email|max:255',
            'motorcycle_brand' => 'required|string|max:255',
            'motorcycle_model' => 'required|string|max:255',
            'last_mileage' => 'nullable|integer|min:0',
            'last_service_date' => 'required|date|before_or_equal:today',
            'service_id' => 'required|string|max:255',
        ]);

        $data = $request->only([
            'customer_name',
            'contact_number',
            'gmail',
            'motorcycle_brand',
            'motorcycle_model',
            'last_mileage',
            'last_service_date',
            'service_id',
        ]);
        
       $log = ServiceLog::create([
            'customer_name' => $data['customer_name'],
            'contact_number' => $data['contact_number'],
            'gmail' => $data['gmail'],
            'motorcycle_brand' => $data['motorcycle_brand'],
            'motorcycle_model' => $data['motorcycle_model'],
            'last_mileage' => $data['last_mileage'] ?? null,
            'last_service_date' => $data['last_service_date'],
            'service_id' => $data['service_id'],
        ]);

    
        // Run AI prediction for this new log so results appear in maintenance view
        $predictionService->predict($log);

        return redirect()->route('admin.service-logs.maintenance', $log)
                         ->with('success', 'Service logged successfully and AI prediction generated.');
    }

    public function maintenance(ServiceLog $serviceLog)
    {
        
        $logs = ServiceLog::query()
            ->when($serviceLog->customer_name, function ($q) use ($serviceLog) {
                $q->where('customer_name', $serviceLog->customer_name);
            })
            ->when($serviceLog->motorcycle_brand, function ($q) use ($serviceLog) {
                $q->where('motorcycle_brand', $serviceLog->motorcycle_brand);
            })
            ->when($serviceLog->motorcycle_model, function ($q) use ($serviceLog) {
                $q->where('motorcycle_model', $serviceLog->motorcycle_model);
            })
            ->orderByDesc('last_service_date')
            ->orderByDesc('created_at')
            ->paginate(10);
    

        $distinctMotors = ServiceLog::query()
            ->where('customer_name', $serviceLog->customer_name)
            ->whereNotNull('motorcycle_brand')
            ->whereNotNull('motorcycle_model')
            ->select('motorcycle_brand', 'motorcycle_model')
            ->distinct()
            ->get();

        $motors = $distinctMotors->map(function ($m) use ($serviceLog) {
            return ServiceLog::query()
                ->where('customer_name', $serviceLog->customer_name)
                ->where('motorcycle_brand', $m->motorcycle_brand)
                ->where('motorcycle_model', $m->motorcycle_model)
                ->orderByDesc('last_service_date')
                ->orderByDesc('created_at')
                ->first();
        })->filter();
        
        $services = Service::orderBy('name')->get(); 

        return view('admin.pages.service-log.maintenance-history', [
            'baseLog' => $serviceLog,
            'logs' => $logs,
            'motors' => $motors,
            'services' => $services,
        ]);
    }

    public function updateMaintenanceRemarks(Request $request, ServiceLog $log)
    {
        $data = $request->validate([
            'remarks' => 'nullable|string',
        ]);

        $log->update(['remarks' => $data['remarks'] ?? null]);

        return back()->with('success', 'Remarks updated successfully.');
    }

    public function storeMaintenanceLog(
        Request $request,
        ServiceLog $serviceLog,
        ServiceLogPredictionService $predictionService
    ) {
        $data = $request->validate([
            'last_mileage' => 'nullable|integer|min:0',
            'last_service_date' => 'required|date|before_or_equal:today',
            'service_id' => 'required|string|max:255',
        ]);

        $newLog = ServiceLog::create([
            'customer_name' => $serviceLog->customer_name,
            'contact_number' => $serviceLog->contact_number,
            'gmail' => $serviceLog->gmail,
            'motorcycle_brand' => $serviceLog->motorcycle_brand,
            'motorcycle_model' => $serviceLog->motorcycle_model,
            'last_mileage' => $data['last_mileage'] ?? null,
            'last_service_date' => $data['last_service_date'],
            'service_id' => $data['service_id'],
        ]);

        $predictionService->predict($newLog);

        return back()->with('success', 'Maintenance log added and AI prediction updated.');
    }

    public function destroyMaintenanceLog(ServiceLog $log)
    {
        $customer = $log->customer_name;
        $brand = $log->motorcycle_brand;
        $model = $log->motorcycle_model;
        $log->delete();
        $target = ServiceLog::query()
            ->where('customer_name', $customer)
            ->where('motorcycle_brand', $brand)
            ->where('motorcycle_model', $model)
            ->orderByDesc('last_service_date')
            ->orderByDesc('created_at')
            ->first();
        if ($target) {
            return redirect()->route('admin.service-logs.maintenance', $target)
                ->with('success', 'Selected maintenance history deleted.');
        }
        return redirect()->route('admin.service-logs.index')
            ->with('success', 'Selected maintenance history deleted.');
    }

    public function deleteMotor(ServiceLog $serviceLog)
    {
        $customer = $serviceLog->customer_name;
        $brand = $serviceLog->motorcycle_brand;
        $model = $serviceLog->motorcycle_model;
        ServiceLog::query()
            ->where('customer_name', $customer)
            ->where('motorcycle_brand', $brand)
            ->where('motorcycle_model', $model)
            ->delete();

        $remaining = ServiceLog::where('customer_name', $customer)
            ->orderByDesc('last_service_date')
            ->orderByDesc('created_at')
            ->first();
        if ($remaining) {
            return redirect()->route('admin.service-logs.maintenance', $remaining)
                ->with('success', 'Motor and all its history deleted.');
        }
        return redirect()->route('admin.service-logs.index')
            ->with('success', 'Motor and all its history deleted.');
    }
    
    /**
     * Add a new motor for an existing customer
     */
    public function addMotor(Request $request, ServiceLog $serviceLog, ServiceLogPredictionService $predictionService)
    {
        $validated = $request->validate([
            'motorcycle_brand' => 'required|string|max:255',
            'motorcycle_model' => 'required|string|max:255',
            'last_mileage' => 'nullable|integer|min:0',
            'last_service_date' => 'required|date|before_or_equal:today',
            'service_id' => 'required|string|max:255',
        ]);

        // Create a new service log for the new motorcycle
        $newLog = ServiceLog::create([
            'customer_name' => $serviceLog->customer_name,
            'contact_number' => $serviceLog->contact_number,
            'gmail' => $serviceLog->gmail,
            'motorcycle_brand' => $validated['motorcycle_brand'],
            'motorcycle_model' => $validated['motorcycle_model'],
            'last_mileage' => $validated['last_mileage'] ?? null,
            'last_service_date' => $validated['last_service_date'],
            'service_id' => $validated['service_id'],
        ]);

        // Generate AI prediction for the new motorcycle
        $predictionService->predict($newLog);

        return redirect()->route('admin.service-logs.maintenance', $newLog)
            ->with('success', 'New motorcycle added successfully and maintenance log created.');
    }
}
