<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'image_url',
        'public_id',
        ];

    public function order_detail(){
        return $this->hasMany(order_detail::class, 'product_id', 'product_id');
    }
}
