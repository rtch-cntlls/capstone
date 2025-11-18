<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    protected $table = 'motorcycles';
    protected $primaryKey = 'motorcycle_id';
    public $incrementing = true;
    protected $keyType = 'int'; 

    protected $fillable = [
        'customer_id',
        'brand',
        'model',
        'issues',
        'maintenance',
    ];

    protected $casts = [
        'issues' => 'array',
        'maintenance' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MotorcycleMaintenanceLog::class, 'motorcycle_id', 'motorcycle_id');
    }

    public function latestMaintenanceLog()
    {
        return $this->hasOne(MotorcycleMaintenanceLog::class, 'motorcycle_id', 'motorcycle_id')->latestOfMany('last_done_at');
    }
}
