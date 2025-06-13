<?php

namespace App\Models;

use App\Models\customer;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
    protected $primaryKey = 'order_id';
    protected $table = 'order';
    protected $guarded = ['order_id'];
    public $incrementing = false;
    protected $fillable = [
        'customer_id',
        'admin_id',
        'tanggal_kirim',
        'waktu',
        'alamat',
        'catatan',
        'jumlah',
        'status_pesanan',
    ];

    protected $cast=[
        'waktu' => 'H:i',
    ];

    public function customer(){
        return $this->belongsTo(customer::class, 'customer_id', 'customer_id');
    }

    public function order_detail(){
        return $this->hasMany(order_detail::class, 'order_id', 'order_id');
    }
}
