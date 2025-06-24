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
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'role', 
    ];

    public function order(){
        return $this->hasMany(order::class, 'customer_id', 'customer_id');
    }
}
