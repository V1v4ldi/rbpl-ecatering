<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\product;
use App\Models\order;

class order_detail extends Model
{
    protected $table = "order_detail";
    protected $primaryKey = 'order_d_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'order_id',
        'product_id',
        'harga_now',
    ];

    public function order(){
        return $this->belongsTo(order::class, 'order_id', 'order_id');
    }

    // Relasi ke product
    public function product(){
        return $this->belongsTo(product::class, 'product_id', 'product_id');
    }
}
