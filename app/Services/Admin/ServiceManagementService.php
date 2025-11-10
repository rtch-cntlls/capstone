<?php

namespace App\Services\Admin;

use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceManagementService
{
    public function getPaginatedServices(int $perPage = 8)
    {
        $query = Service::query();
    
        if (request()->has('status') && in_array(request('status'), ['Active', 'Inactive'])) {
            $query->where('status', request('status'));
        }
    
        return $query->paginate($perPage);
    }

    public function getCardsData(): array
    {
        $stats = Service::select('status', DB::raw('COUNT(*) as total'))
            ->whereIn('status', ['Active', 'Inactive'])
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            [
                'title' => 'Active', 'value' => $stats['Active'] ?? 0, 'type' => 'services',
                'color' => 'text-success', 'icon' => 'fas fa-check-circle',
            ],
            [
                'title' => 'Inactive', 'value' => $stats['Inactive'] ?? 0,  'type' => 'services',
                'color' => 'text-danger', 'icon' => 'fas fa-times-circle',
            ],
        ];
    }

    public function getServicesDataFromJson(): array
    {
        $jsonPath = public_path('services/services.json');

        if (! file_exists($jsonPath)) {
            return [];
        }

        return json_decode(file_get_contents($jsonPath), true) ?? [];
    }

    public function findCategoryForService(string $name, array $servicesData): string
    {
        foreach ($servicesData as $cat) {
            if (in_array($name, $cat['services'], true)) {
                return $cat['category'];
            }
        }

        return 'Uncategorized';
    }

    public function createService(array $data): Service
    {
        return DB::transaction(function () use ($data) {
            $servicesData = $this->getServicesDataFromJson();
            $category     = $this->findCategoryForService($data['name'], $servicesData);

            return Service::create([
                'name'        => $data['name'],
                'category'    => $category,
                'price'       => $data['price'],
                'duration'    => $data['duration'] ?? null,
                'status'      => 'Active',
            ]);
        });
    }

    public function updateService(Service $service, array $data): bool
    {
        return DB::transaction(function () use ($service, $data) {
            return $service->update([
                'name'        => $data['name'],
                'price'       => $data['price'],
                'duration'    => $data['duration'] ?? null,
                'description' => $data['description'] ?? null,
            ]);
        });
    }

    public function toggleServiceStatus(Service $service): Service
    {
        return DB::transaction(function () use ($service) {
            $service->status = $service->status === 'Active' ? 'Inactive' : 'Active';
            $service->save();

            return $service;
        });
    }
}
