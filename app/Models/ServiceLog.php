<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLog  extends Model
{
    protected $fillable = [
        'customer_name',
        'contact_number',
        'gmail',
        'motorcycle_brand',
        'motorcycle_model',
        'mileage',
        'service_date',
        'service_id',
        'motorcycle_id',
        'next_due_mileage',
        'next_due_date',
        'ai_reasoning',
        'remarks',
        'road_condition',
        'usage_frequency',
    ];

    protected $casts = [
        'ai_reasoning' => 'array',
    ];

 public function service()
{
    return $this->belongsTo(Service::class, 'service_id');
}


    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class, 'motorcycle_id', 'motorcycle_id');
    }
}
