<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class member extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    public function order()
    {
        return $this->hasMany(order::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
