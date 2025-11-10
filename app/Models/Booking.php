<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes; 
    
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
        return $this->belongsTo(Customer::class, 'customer_id')->withTrashed();
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}

