<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $fillable = [
        'name',
        'cif',
        'portofolio',
        'penempatan',
        'dana',
        'waktu',
        'tanggal',
        'ajuan_nisbah',
        'nisbah_rate',
        'status',
    ];
}
