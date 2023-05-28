<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(category::class, 'id_kategori','id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
