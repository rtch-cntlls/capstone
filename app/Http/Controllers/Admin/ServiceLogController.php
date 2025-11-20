<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ServiceLogService;
use App\Models\ServiceLog;
use App\Models\Service;
use App\Services\Admin\ServiceLogPredictionService;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerAccountCreated;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'gmail' => 'required|email|max:255',
            'motorcycle_brand' => 'required|string|max:255',
            'motorcycle_model' => 'required|string|max:255',
            'mileage' => 'required|integer|min:0',
            'service_date' => 'required|date|before_or_equal:today',
            'service_id' => 'required|string|max:255',
            'road_condition' => 'nullable|string|max:255',
            'road_condition_other' => 'nullable|string|max:255',
            'usage_frequency' => 'nullable|string|max:255',
            'usage_frequency_other' => 'nullable|string|max:255',
        ]);
    
        $nameParts = explode(' ', $request->customer_name, 2);
        $firstname = $nameParts[0] ?? '';
        $lastname = $nameParts[1] ?? '';
        $randomPassword = Str::random(12);
        $user = User::firstOrCreate(
            ['email' => $request->gmail],
            [
                'role_id'   => 2,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'password' => Hash::make($randomPassword),
            ]
        );

        Mail::to($user->email)->send(new CustomerAccountCreated($firstname, $user->email, $randomPassword));

        $customer = Customer::firstOrCreate(
            ['user_id' => $user->user_id],
            ['phone' => $request->contact_number]
        );

        $roadCondition = ($request->road_condition === 'others')
            ? $request->road_condition_other
            : $request->road_condition;
    
        $usageFrequency = ($request->usage_frequency === 'others')
            ? $request->usage_frequency_other
            : $request->usage_frequency;

        $log = ServiceLog::create([
            'customer_name' => $request->customer_name,
            'contact_number' => $request->contact_number,
            'gmail' => $request->gmail,
            'motorcycle_brand' => $request->motorcycle_brand,
            'motorcycle_model' => $request->motorcycle_model,
            'mileage' => $request->mileage,
            'service_date' => $request->service_date,
            'service_id' => $request->service_id,
            'road_condition' => $roadCondition,
            'usage_frequency' => $usageFrequency,
        ]);

        $predictionService->predict($log);
    
        return redirect()->route('admin.service-logs.maintenance', $log)
                         ->with('success', 'Service logged successfully, AI prediction generated, and customer account created.');
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
            ->orderByDesc('service_date')
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
                ->orderByDesc('service_date')
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

    public function storeMaintenanceLog(Request $request, ServiceLog $serviceLog, ServiceLogPredictionService $predictionService ) 
    {
        $data = $request->validate([
            'mileage' => 'nullable|integer|min:0',
            'service_date' => 'required|date|before_or_equal:today',
            'service_id' => 'required|string|max:255',
            'road_condition' => 'nullable|string|max:255',
            'road_condition_other' => 'nullable|string|max:255',
            'usage_frequency' => 'nullable|string|max:255',
            'usage_frequency_other' => 'nullable|string|max:255',
        ]);

        $roadCondition = ($data['road_condition'] ?? null) === 'others'
            ? ($data['road_condition_other'] ?? null)
            : ($data['road_condition'] ?? null);
        $usageFrequency = ($data['usage_frequency'] ?? null) === 'others'
            ? ($data['usage_frequency_other'] ?? null)
            : ($data['usage_frequency'] ?? null);

        $newLog = ServiceLog::create([
            'customer_name' => $serviceLog->customer_name,
            'contact_number' => $serviceLog->contact_number,
            'gmail' => $serviceLog->gmail,
            'motorcycle_brand' => $serviceLog->motorcycle_brand,
            'motorcycle_model' => $serviceLog->motorcycle_model,
            'mileage' => $data['mileage'] ?? null,
            'service_date' => $data['service_date'],
            'service_id' => $data['service_id'],
            'road_condition' => $roadCondition,
            'usage_frequency' => $usageFrequency,
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
            ->orderByDesc('service_date')
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
            ->orderByDesc('service_date')
            ->orderByDesc('created_at')
            ->first();
        if ($remaining) {
            return redirect()->route('admin.service-logs.maintenance', $remaining)
                ->with('success', 'Motor and all its history deleted.');
        }
        return redirect()->route('admin.service-logs.index')
            ->with('success', 'Motor and all its history deleted.');
    }

    public function addMotor(Request $request, ServiceLog $serviceLog, ServiceLogPredictionService $predictionService)
    {
        $validated = $request->validate([
            'motorcycle_brand' => 'required|string|max:255',
            'motorcycle_model' => 'required|string|max:255',
            'mileage' => 'required|integer|min:0',
            'service_date' => 'required|date|before_or_equal:today',
            'service_id' => 'required|string|max:255',
            'road_condition' => 'nullable|string|max:255',
            'road_condition_other' => 'nullable|string|max:255',
            'usage_frequency' => 'nullable|string|max:255',
            'usage_frequency_other' => 'nullable|string|max:255',
        ]);

        $roadCondition = ($validated['road_condition'] ?? null) === 'others'
            ? ($validated['road_condition_other'] ?? null)
            : ($validated['road_condition'] ?? null);
        $usageFrequency = ($validated['usage_frequency'] ?? null) === 'others'
            ? ($validated['usage_frequency_other'] ?? null)
            : ($validated['usage_frequency'] ?? null);

        $newLog = ServiceLog::create([
            'customer_name' => $serviceLog->customer_name,
            'contact_number' => $serviceLog->contact_number,
            'gmail' => $serviceLog->gmail,
            'motorcycle_brand' => $validated['motorcycle_brand'],
            'motorcycle_model' => $validated['motorcycle_model'],
            'mileage' => $validated['mileage'] ?? null,
            'service_date' => $validated['service_date'],
            'service_id' => $validated['service_id'],
            'road_condition' => $roadCondition,
            'usage_frequency' => $usageFrequency,
        ]);

        $predictionService->predict($newLog);

        return redirect()->route('admin.service-logs.maintenance', $newLog)
            ->with('success', 'New motorcycle added successfully and maintenance log created.');
    }
}
