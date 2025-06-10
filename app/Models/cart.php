<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = "cart";
    protected $primaryKey = 'cart_id';
    public $incrementing = false;
    protected $fillable = [
        'customer_id'
    ];

    
}
