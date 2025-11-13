<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'inventory_id';
    protected $appends = ['code'];
    protected $fillable = [
        'product_id',
        'instock',
        'available_stock',
        'stock_status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function histories()
    {
        return $this->hasMany(InventoryHistory::class, 'inventory_id', 'inventory_id');
    }
}
