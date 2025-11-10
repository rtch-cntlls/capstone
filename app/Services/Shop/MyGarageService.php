<?php

namespace App\Services\Shop;

use App\Models\Customer;
use App\Models\Motorcycle;
use App\Models\Shop;
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
        $path = storage_path('app/public/motorcycle/MotorcycleData.json');
    
        if (file_exists($path)) {
            $json = file_get_contents($path);
            return json_decode($json, true) ?? [];
        }
    
        return [];
    }    

    public function getCustomerMotorcycles($perPage = 5)
    {
        $customer = Auth::user()->customer;
        return $customer ? $customer->motorcycles()->paginate($perPage) : collect([]);
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
    
        FetchMotorcycleData::dispatch($motorcycle->getKey());
    
        return [
            'status' => 'success',
            'motorcycle' => $motorcycle,
            'message' => 'Motorcycle added. AI is fetching details, please refresh later.'
        ];
    }
    

    public function getMotorcycleDetails($id)
    {
        $motorcycle = Motorcycle::findOrFail($id);

        $issues = $motorcycle->issues ?? ['basic' => [], 'mechanic_required' => []];
        $maintenance = $motorcycle->maintenance ?? ['overview' => '', 'schedule' => []];

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
