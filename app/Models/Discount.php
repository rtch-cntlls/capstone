<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{   
    protected $primaryKey = 'discount_id';
    protected $fillable = [
        'title',
        'discount_percent',
        'discount_amount',
        'start_date',
        'expiry_date',
        'status',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'promo_products', 'discount_id', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Product::class, 'category_id', 'category_id');
    }
}
