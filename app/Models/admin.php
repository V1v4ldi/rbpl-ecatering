<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    //
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nama', 
        'email',
        'password',];
}
