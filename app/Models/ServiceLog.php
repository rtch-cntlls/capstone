<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLog  extends Model
{
    protected $fillable = [
        'customer_name',
        'contact_number',
        'service_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }
}
