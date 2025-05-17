<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class owner extends Model
{
    //
    protected $primaryKey = 'owner_id';
    protected $guarded = ['owner_id'];
}
