<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\report;
use App\Models\order;

class daily_report extends Model
{
    protected $table = 'daily_report';
    protected $primaryKey = 'report_d_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'report_d_id',
        'report_id',
        'order_id',
        'tanggal',
    ];

    protected $casts =[
        'tanggal' => 'date',
    ];

    public function report()
    {
        return $this->belongsTo(report::class, 'report_id', 'report_id');
    }
    
    public function order()
    {
        return $this->belongsTo(order::class, 'order_id', 'order_id');
    }

    public function getOrderTotal()
    {
        $sum_harga = $this->order->orderDetails->sum('harga_now');

        return $sum_harga * $this->order->jumlah;
    }
}
