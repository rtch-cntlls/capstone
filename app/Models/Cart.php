<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cart_id'; 
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'customer_id', 
        'product_id', 
        'quantity'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
