<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $fillable = [
        'date',
        'buy_price',
        'sell_price',
        'harga5',
        'harga10',
        'harga25',
        'harga50',
        'harga100',
        'creted_at',
        'updated_at'
    ];
}
