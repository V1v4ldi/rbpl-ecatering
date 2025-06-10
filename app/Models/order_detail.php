<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    protected $table = "order_detail";
    protected $primaryKey = 'order_d_id';
    public $incrementing = false;
    protected $fillable = [
        'order_id',
        'product_id',
        'harga_now',
        'jumlah',
    ];
}
