<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $primaryKey = 'order_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'address_id',
        'order_number',
        'status',
        'payment_status',
        'payment_method',
        'payment_proof',
        'delivery_type',
        'order_type',
        'subtotal',
        'discount_total',
        'grand_total',
        'placed_at',
        'expected_delivery_date',
        'delivered_at',
        'cancelled_at',
    ];

    protected $casts = [
        'delivered_at' => 'datetime',
    ];
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id')->withTrashed();
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'order_id', 'order_id');
    }

    public function sale()
    {
        return $this->hasOne(Sale::class, 'order_id', 'order_id');
    }
}