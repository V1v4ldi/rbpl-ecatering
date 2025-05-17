<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    //
    protected $primaryKey = 'admin_id';
    protected $guarded = ['admin_id'];
}
