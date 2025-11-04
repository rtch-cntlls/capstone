<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $primaryKey = 'announcement_id';

    protected $fillable = [
        'title',
        'type',
        'product_id',
        'discount_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // public function discount()
    // {
    //     return $this->belongsTo(Discount::class, 'discount_id');
    // }
}
