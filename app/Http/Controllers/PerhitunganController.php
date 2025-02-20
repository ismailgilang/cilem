<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $data = Nasabah::all();
        return view('menu.perhitungan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisbah_rate' => 'required|numeric',
        ], [
            'nisbah_rate.required' => 'Eq.Rate Wajib Diisi',
        ]);

        $id = $request->input('id');
        $nasabah = Nasabah::find($id);

        if ($nasabah) {
            // Hitung perhitungan: ajuan_nisbah x nisbah_rate dari request
            $calculation = $request->nisbah_rate  / $nasabah->ajuan_nisbah;
            $calculation2 = $request->nisbah_rate  / $calculation;
            // Update field nisbah_rate dan status menggunakan metode update
            $nasabah->update([
                'nisbah_rate' => $request->nisbah_rate,
                'status'      => $calculation2,
            ]);

            return redirect()->route('perhitungan.index')->with('success', 'Data Nisbah berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Data Nisbah tidak ditemukan.');
        }
    }
}
