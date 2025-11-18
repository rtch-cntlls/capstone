<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Motorcycle;
use App\Models\ServiceLog;
use App\Services\Shop\MyGarageService;
use App\Services\Api\MaintenancePredictionService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class MyGarageController extends Controller
{
    protected $garageService;

    public function __construct(MyGarageService $garageService)
    {
        $this->garageService = $garageService;
    }

    public function index()
    {
        $brands = $this->garageService->getBrands();
        $shop = $this->garageService->getShop();
        $motorcycles = $this->garageService->getCustomerMotorcycles();

        return view('client.pages.garage.index', compact('motorcycles', 'brands', 'shop'));
    }

    public function store(Request $request)
    {
        $brands = $this->garageService->getBrands();

        $request->validate([
            'brand' => 'required|string|in:' . implode(',', array_keys($brands)),
            'model' => 'required|string|max:255',
            'mileage_at_service' => 'required|integer|min:0|max:100000',
            'last_done_at' => 'required|date|before_or_equal:today',
            'service_type' => 'required|string|max:255',
        ]);

        $result = $this->garageService->storeMotorcycle($request->only([
            'brand', 'model', 'mileage_at_service', 'last_done_at', 'service_type'
        ]));

        if ($result['status'] === 'error') {
            return redirect()->route('garage.index')->with('error', $result['message']);
        }

        return redirect()->route('garage.index')->with('success', 'Motorcycle added successfully!');
    }

    public function show($motorcycle_id)
    {
        $shop = $this->garageService->getShop();
        $details = $this->garageService->getMotorcycleDetails($motorcycle_id);

        return view('client.pages.garage.show', array_merge(['shop' => $shop], $details));
    }

    public function schedule($motorcycle_id)
    {
        $shop = $this->garageService->getShop();
        $details = $this->garageService->getMotorcycleSchedule($motorcycle_id);

        return view('client.pages.garage.schedule', array_merge(['shop' => $shop],
            $details
        ));
    }
    
    public function maintenance(Motorcycle $motorcycle)
    {
        $shop = $this->garageService->getShop();
        $user = Auth::user();

        $serviceLogs = collect();
        $latestServiceLog = null;

        if ($user && !empty($user->email)) {
            $serviceLogs = ServiceLog::query()
                ->where('gmail', $user->email)
                ->where('motorcycle_brand', $motorcycle->brand)
                ->where('motorcycle_model', $motorcycle->model)
                ->orderByDesc('last_service_date')
                ->orderByDesc('created_at')
                ->get();

            $latestServiceLog = $serviceLogs->first();
        }

        if ($serviceLogs->isNotEmpty()) {
            return view('client.pages.garage.maintenance', [
                'shop' => $shop,
                'motorcycle' => $motorcycle,
                'latestMaintenance' => $latestServiceLog,
                'serviceLogs' => $serviceLogs,
            ]);
        }

        $latestMaintenance = $motorcycle->maintenanceLogs()->latest('last_done_at')->first();
        $currentMileage = (int) ($motorcycle->current_mileage ?? 0);

        $latestPrediction = $latestMaintenance;

        if ($latestMaintenance) {
            $aiAlreadyAttempted = $latestMaintenance->ai_attempted ?? false;

            if (!$aiAlreadyAttempted && (
                empty($latestMaintenance->next_due_mileage) ||
                empty($latestMaintenance->next_due_date) ||
                empty($latestMaintenance->ai_reasoning)
            )) {
                try {
                    $predictionService = app(\App\Services\Api\MaintenancePredictionService::class);
                    $predicted = $predictionService->predict($motorcycle, $currentMileage);
                    if ($predicted) {
                        $latestPrediction = $predicted;
                    }

                    $latestMaintenance->update(['ai_attempted' => true]);

                } catch (\Throwable $e) {
                    \Log::error("Maintenance AI prediction failed for motorcycle ID {$motorcycle->id}: " . $e->getMessage());
                    $latestMaintenance->update(['ai_attempted' => true]);
                }
            }
        }

        return view('client.pages.garage.maintenance', [
            'shop' => $shop,
            'motorcycle' => $motorcycle,
            'latestMaintenance' => $latestPrediction,
        ]);
    }    
}
