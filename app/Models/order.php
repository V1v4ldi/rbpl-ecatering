<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
    protected $primaryKey = 'order_id';
    protected $guarded = ['order_id'];
}
