<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cilem extends Model
{
    protected $fillable = [
        'name',
        'nik',
        'banyak',
        'harga_asli',
        'uang_muka',
        'pembiayaan',
        'adm',
        'tot_adm',
        'angsuran',
        'bayar_angsuran',
        'created_at'
    ];
}
