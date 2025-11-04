<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    public $incrementing  = true;
    protected $keyType    = 'int';

    protected $fillable   = ['name'];


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
