<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryHistory extends Model
{
    protected $table = 'inventoryhistory';
    protected $primaryKey = 'inventoryhistory_id';
    protected $casts = [
        'action_date' => 'datetime',
    ];
    protected $fillable = [
        'inventory_id',
        'quantity',
        'action_date',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
    }
}
