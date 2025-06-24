<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Auth\User as Authenticatable;

class owner extends Authenticatable
{
    //
    
    protected $table = 'owner';
    protected $primaryKey = 'owner_id';
    protected $keyType = 'string';
    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
    ];
}
