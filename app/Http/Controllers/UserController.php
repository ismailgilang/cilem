<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $tahunSekarang = Carbon::now()->year;

        // Ambil data tahun berjalan
        $hargaData = Harga::whereYear('created_at', $tahunSekarang)
            ->orderBy('created_at', 'asc')
            ->get();

        $bulan = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        $buyPrices = array_fill(0, 12, null);
        $sellPrices = array_fill(0, 12, null);

        foreach ($hargaData as $data) {
            $monthIndex = Carbon::parse($data->created_at)->month - 1;
            $buyPrices[$monthIndex] = $data->buy_price;
            $sellPrices[$monthIndex] = $data->sell_price;
        }

        // Ambil harga tertinggi untuk menentukan skala maksimal grafik
        $maxHarga = max(array_filter(array_merge($buyPrices, $sellPrices))) ?? 0;

        return view('dashboard', compact('bulan', 'buyPrices', 'sellPrices', 'maxHarga'));
    }
}
