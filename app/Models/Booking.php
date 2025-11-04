<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings'; 
    protected $primaryKey = 'booking_id';
    public $timestamps = true;

    protected $fillable = [
        'customer_id',
        'service_id',
        'schedule',
        'notes',
        'status',
    ];

    public function getCodeAttribute()
    {
        return 'BK-' . str_pad($this->booking_id, 6, '0', STR_PAD_LEFT);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}

