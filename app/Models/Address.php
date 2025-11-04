<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = 'address_id';  
    public $incrementing = true;           
    protected $keyType = 'int';    

    protected $fillable = [
        'customer_id',
        'street',
        'barangay',
        'city',
        'province',
        'postal_code',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
    
}
