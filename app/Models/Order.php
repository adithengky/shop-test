<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'qty',
        'total'
    ];

    function product() 
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    function user() 
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
