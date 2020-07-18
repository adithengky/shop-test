<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'user_id',
        'qty',
        'total'
    ];

    protected $dates = ['deleted_at'];

    function product() 
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    function user() 
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
