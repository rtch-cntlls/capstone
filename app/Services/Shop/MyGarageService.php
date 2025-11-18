<?php

namespace App\Services\Shop;

use App\Models\Customer;
use App\Models\Motorcycle;
use App\Models\ServiceLog;
use App\Models\Shop;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\FetchMotorcycleData;
use App\Services\Api\MotorcycleAIService;

class MyGarageService
{
    protected $aiService;

    public function __construct(MotorcycleAIService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function getBrands(): array
    {
        $path = public_path('motorcycle/MotorcycleData.json');
    
        if (file_exists($path)) {
            $json = file_get_contents($path);
            return json_decode($json, true) ?? [];
        }
    
        return [];
    }      

    public function getCustomerMotorcycles($perPage = 5)
    {
        $user = Auth::user();

        if (!$user || empty($user->email)) {
            $customer = $user?->customer;
            return $customer ? $customer->motorcycles()->paginate($perPage) : collect([]);
        }

        $email = $user->email;

        $logs = ServiceLog::query()
            ->where('gmail', $email)
            ->whereNotNull('motorcycle_brand')
            ->whereNotNull('motorcycle_model')
            ->orderByDesc('last_service_date')
            ->orderByDesc('created_at')
            ->get();

        if ($logs->isEmpty()) {
            $customer = $user->customer;
            return $customer ? $customer->motorcycles()->paginate($perPage) : collect([]);
        }

        $customer = $user->customer ?? $user->customer()->create([]);

        $grouped = $logs->groupBy(function (ServiceLog $log) {
            return $log->motorcycle_brand . '|' . $log->motorcycle_model;
        });

        $motorcycles = $grouped->map(function ($group) use ($customer) {
            $baseLog = $group->first();

            return Motorcycle::firstOrCreate([
                'customer_id' => $customer->customer_id,
                'brand'       => $baseLog->motorcycle_brand,
                'model'       => $baseLog->motorcycle_model,
            ]);
        })->values();

        $page = request()->get('page', 1);
        $page = (int) ($page ?: 1);
        $perPage = (int) $perPage;

        if ($motorcycles->isEmpty()) {
            return new LengthAwarePaginator([], 0, $perPage, $page, [
                'path'  => request()->url(),
                'query' => request()->query(),
            ]);
        }

        $items = $motorcycles->forPage($page, $perPage)->values();

        return new LengthAwarePaginator(
            $items,
            $motorcycles->count(),
            $perPage,
            $page,
            [
                'path'  => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function storeMotorcycle(array $data)
    {
        $customer = Auth::user()->customer ?? Auth::user()->customer()->create([]);
        
        if ($customer->motorcycles()->count() >= 5) {
            return [
                'status' => 'error',
                'message' => 'You can only register up to 5 motorcycles.'
            ];
        }
        
        $motorcycle = DB::transaction(function () use ($customer, $data) {
            $duplicate = $customer->motorcycles()
                ->where('brand', $data['brand'])
                ->where('model', $data['model'])
                ->first();
    
            if ($duplicate) {
                return null;
            }
    
            return $customer->motorcycles()->create([
                'brand' => $data['brand'],
                'model' => $data['model'],
            ]);
        });
    
        if (!$motorcycle) {
            return [
                'status' => 'error',
                'message' => 'This motorcycle is already in your garage.'
            ];
        }
        
        if (!empty($data['mileage_at_service']) && !empty($data['service_type'])) {
            $motorcycle->maintenanceLogs()->create([
                'service_type'       => $data['service_type'],
                'mileage_at_service' => $data['mileage_at_service'],
                'last_done_at'       => $data['last_done_at'],
            ]);
        }
    
        // Run synchronously so results are available without a queue worker
        FetchMotorcycleData::dispatchSync($motorcycle->getKey());
    
        return [
            'status' => 'success',
            'motorcycle' => $motorcycle,
            'message' => 'Motorcycle added. AI is fetching details, please refresh later.'
        ];
    }
    

    public function getMotorcycleDetails($id)
    {
        $motorcycle = Motorcycle::findOrFail($id);

        $issues = $motorcycle->issues;
        $maintenance = $motorcycle->maintenance;

        if (empty($issues) || empty($maintenance)) {
            try {
                if (empty($issues)) {
                    $issues = $this->aiService->getCommonIssues($motorcycle->brand, $motorcycle->model);
                }

                if (empty($maintenance)) {
                    $maintenance = $this->aiService->getMaintenanceRecommendations($motorcycle->brand, $motorcycle->model);
                }

                $update = [];
                if (!empty($issues)) {
                    $update['issues'] = $issues;
                }
                if (!empty($maintenance)) {
                    $update['maintenance'] = $maintenance;
                }

                if (!empty($update)) {
                    $motorcycle->update($update);
                }
            } catch (\Throwable $e) {
                \Log::error('Synchronous motorcycle AI fetch failed for ID '.$motorcycle->motorcycle_id.': '.$e->getMessage());
            }
        }

        $issues = $issues ?? ['basic' => [], 'mechanic_required' => []];
        $maintenance = $maintenance ?? ['overview' => '', 'schedule' => []];

        return compact('motorcycle', 'issues', 'maintenance');
    }

    public function getMotorcycleSchedule($id)
    {
        $motorcycle = Motorcycle::findOrFail($id);
        $maintenance = $motorcycle->maintenance ?? ['overview' => '', 'schedule' => []];

        return compact('motorcycle', 'maintenance');
    }

    public function getShop()
    {
        return Shop::first();
    }
}
