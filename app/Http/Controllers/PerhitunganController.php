<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $data = Nasabah::whereRaw("CAST(REPLACE(REPLACE(portofolio, 'Rp ', ''), '.', '') AS UNSIGNED) > ?", [400000000])->get();
        return view('menu.perhitungan.index', compact('data'));
    }
}
