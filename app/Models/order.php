<?php

namespace App\Models;

use App\Models\customer;
use App\Models\order_detail;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
    protected $primaryKey = 'order_id';
    protected $table = 'order';
    protected $guarded = ['order_id'];
    public $incrementing = false;
    protected $keyType = 'string';
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

    public function customer(){
        return $this->belongsTo(customer::class, 'customer_id', 'customer_id');
    }

    public function order_detail(){
        return $this->hasMany(order_detail::class, 'order_id', 'order_id');
    }

    public function orderDetails(){
        return $this->order_detail();
    }
    // Accessor untuk menghitung total harga
    public function getTotalHargaAttribute()
    {
        return $this->orderDetails->sum(function($detail) {
            return $detail->harga_now * $this->jumlah;
        });
    }

    // Accessor untuk format tanggal
    public function getTanggalFormatAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_kirim)->translatedFormat('j F Y');
    }

    // Accessor untuk format waktu
    public function getWaktuFormatAttribute()
    {
        return \Carbon\Carbon::parse($this->waktu)->format('H:i');
    }

    // Method untuk menghitung subtotal (tanpa jumlah)
    public function getSubtotalAttribute()
    {
        return $this->orderDetails->sum('harga_now');
    }
}
