<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\daily_report;
use App\Models\order;
use App\Models\owner;

class report extends Model
{
    //
    protected $table = 'report';
    protected $primaryKey = 'report_id';
    protected $guarded = ['report_id'];
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'report_id',
        'owner_id',
        'type',
        'period',
        'total_revenue',
        'total_order',
        'average_order',
        'best_seller',
    ];

    protected $casts =[
        'total_revenue' => 'integer',
        'average_order' => 'integer',
        'total_order' => 'integer',
    ];

    public function daily_reports(){
        return $this->hasMany(daily_report::class, 'report_id', 'report_id');
    }

    // Alias untuk backward compatibility
    public function daily_report(){
        return $this->daily_reports();
    }

    public function order(){
        return $this->hasManyThrough(
            order::class,
            daily_report::class,
            'report_id',
            'order_id',
            'report_id',
            'order_id',
        );
    }

    public function owner(){
        return $this->belongsTo(owner::class, 'owner_id', 'owner_id');
    }
}
