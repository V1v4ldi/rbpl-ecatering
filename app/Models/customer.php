<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Auth\User as Authenticatable;

class customer extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = "customer";
    protected $primaryKey = 'customer_id';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'role', 
    ];
}
