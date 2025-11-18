<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotorcycleMaintenanceLog extends Model
{
    protected $table = 'motorcycle_maintenance_logs';
    protected $primaryKey = 'log_id';
    public $timestamps = true;

    protected $casts = [
        'ai_reasoning' => 'array',
    ];
    
    protected $fillable = [
        'motorcycle_id',
        'service_type',
        'mileage_at_service',
        'last_done_at',
        'ai_reasoning',
        'next_due_date',
        'next_due_mileage',
        'remarks',
    ];

    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class, 'motorcycle_id', 'motorcycle_id');
    }
}
