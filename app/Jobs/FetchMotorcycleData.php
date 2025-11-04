<?php

namespace App\Jobs;

use App\Models\Motorcycle;
use App\Services\Api\MotorcycleAIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchMotorcycleData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $motorcycleId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $motorcycleId)
    {
        $this->motorcycleId = $motorcycleId;
    }

    /**
     * Execute the job.
     */
    public function handle(MotorcycleAIService $aiService): void
    {
        $motorcycle = Motorcycle::find($this->motorcycleId);
    
        if (!$motorcycle) {
            return;
        }
    
        $issues = $aiService->getCommonIssues($motorcycle->brand, $motorcycle->model);
        $maintenance = $aiService->getMaintenanceRecommendations($motorcycle->brand, $motorcycle->model);
    
        $updateData = [];
        if (!empty($issues['basic']) || !empty($issues['mechanic_required'])) {
            $updateData['issues'] = $issues;
        }
        if (!empty($maintenance['schedule']) || !empty($maintenance['overview'])) {
            $updateData['maintenance'] = $maintenance;
        }
    
        if (!empty($updateData)) {
            $motorcycle->update($updateData);
        }
    }
    
}
