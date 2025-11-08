<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'category_id',
        'description',
        'condition',
        'status',
        'cost_price',
        'sale_price',
        'weight_kg',
        'image',
        'material',
        'color_finish',
        'specs',
    ];

    protected $casts = [
        'specs' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'product_id', 'product_id');
    }
    
    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'promo_products', 'product_id', 'discount_id');
    }

    public function discount()
    {
        return $this->belongsToMany(Discount::class, 'promo_products', 'product_id', 'discount_id')
                    ->latest() 
                    ->limit(1);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class, 'product_id', 'product_id');
    }

    public function getConditionAttribute(): string
    {
        $addedAt = $this->product->created_at ?? $this->created_at;
        
        return $addedAt->gt(now()->subWeeks(3)) ? 'New' : 'Old';
    }
}
