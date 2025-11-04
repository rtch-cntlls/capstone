<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shop';

    protected $primaryKey = 'shop_id';

    protected $fillable = [
        'shop_name',
        'province',
        'city',
        'barangay',
        'enable_direct_buy',
        'service_area',
        'shipping_fee_local',
        'shipping_fee_province',
        'shipping_fee_luzon',
        'shipping_fee_visayas',
        'shipping_fee_mindanao',
        'payment_cod',
        'payment_gcash',
    ];
}
