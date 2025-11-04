<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    protected $casts = [
        'issues' => 'array',
        'maintenance' => 'array',
    ];
    protected $table = 'motorcycles';
    protected $primaryKey = 'motorcycle_id';

    protected $fillable = [
        'customer_id',
        'brand',
        'model',
        'issues',
        'maintenance',
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
    
    public function maintenanceLogs()
    {
        return $this->hasMany(MotorcycleMaintenanceLog::class, 'motorcycle_id', 'motorcycle_id');
    }    
}
