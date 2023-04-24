<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_qty',
    ];

    protected $with = ['product'];  //to pass it in javascript
    public function product()  //to pass the relationship in laravel
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
