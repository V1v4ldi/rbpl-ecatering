<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'imgname'];

    public function order_detail(){
        return $this->hasOne(order_detail::class, 'product_id', 'product_id');
    }
}
