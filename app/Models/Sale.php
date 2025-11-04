<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $primaryKey = 'sale_id';

    protected $fillable = [
        'order_id',
        'customer_id',
        'sale_type',
        'sale_date',
        'amount_pay',
        'change',
        'grand_total',
    ];

    protected $casts = [
        'sale_date' => 'datetime',
    ];

    public function getSaleCodeAttribute()
    {
        return 'ST' . $this->created_at->format('mdy');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class, 'sale_id', 'sale_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
