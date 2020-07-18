<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    function order() 
    {
        return $this->belongsTo('App\Models\Order', 'id', 'product_id');
    }
}
