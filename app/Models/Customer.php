<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes; 
    
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'phone',
    ];
 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }    

    public function motorcycles(): HasMany
    {
        return $this->hasMany(Motorcycle::class, 'customer_id', 'customer_id');
    }
    
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'customer_id', 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

}
