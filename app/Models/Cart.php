<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(member::class, 'id_member','id');
    }
    public function product()
    {
        return $this->belongsTo(product::class, 'id_barang','id');
    }
}
