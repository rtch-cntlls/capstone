<?php

namespace App\Jobs;

use App\Services\Api\MaintenancePredictionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PredictMaintenanceNeeds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $motorcycleId;
    public int $currentMileage;

    /**
     * Create a new job instance.
     */
    public function __construct(int $motorcycleId, int $currentMileage)
    {
        $this->motorcycleId = $motorcycleId;
        $this->currentMileage = $currentMileage;
    }

    /**
     * Execute the job.
     */
    public function handle(MaintenancePredictionService $predictionService): void
    {
        try {
            $result = $predictionService->predictAndStore($this->motorcycleId, $this->currentMileage);

            Log::info("✅ Maintenance prediction completed for motorcycle #{$this->motorcycleId}", [
                'predictions' => $result['predictions'] ?? []
            ]);
        } catch (\Throwable $e) {
            Log::error("❌ Maintenance prediction failed for motorcycle #{$this->motorcycleId}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
