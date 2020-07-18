<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price'
    ];

    protected $dates = ['deleted_at'];

    function order() 
    {
        return $this->belongsTo('App\Models\Order', 'id', 'product_id');
    }
}
