<?php

namespace App\Models;

use App\Models\product;
use App\Models\cart;
use Illuminate\Database\Eloquent\Model;

class cart_detail extends Model
{
    protected $table = "cart_detail";
    protected $primaryKey = 'cart_d_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'product_id',
        'cart_id',
    ];

    public function product(){
        return $this->belongsTo(product::class, 'product_id', 'product_id');
    }

    public function cart()
    {
        return $this->belongsTo(cart::class, 'cart_id', 'cart_id');
    }

    
}
