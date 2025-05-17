<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $primaryKey = 'product_id';
    protected $guarded = ['product_id'];
}
