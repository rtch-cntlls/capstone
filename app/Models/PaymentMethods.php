<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    protected $table = 'payment_methods';
    protected $primaryKey = 'payment_id'; 
    public $incrementing = true; 
    protected $keyType = 'int'; 

    protected $fillable = [
        'name',
        'enabled',
        'account_name',
        'account_number',
        'account_email',
        'qr_code_path',
    ];
}
