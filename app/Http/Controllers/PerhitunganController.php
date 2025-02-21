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

    public function store(Request $request)
    {
        //
    }

    public function upload(Request $request)
    {
        $request->validate([
            'persetujuan' => 'required|string',
        ], [
            'persetujuan.required' => 'Field persetujuan wajib diisi',
        ]);

        // Temukan record Nasabah berdasarkan id yang dikirimkan
        $data = Nasabah::findOrFail($request->id);

        // Update field persetujuan dengan inputan dari request
        $data->update([
            'persetujuan' => $request->persetujuan,
        ]);

        return redirect()->back()->with('success', 'Field persetujuan berhasil diupdate.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'persetujuan2' => 'required|string',
        ], [
            'persetujuan2.required' => 'Field persetujuan wajib diisi',
        ]);

        // Temukan record Nasabah berdasarkan id yang dikirimkan
        $data = Nasabah::findOrFail($id);

        // Update field persetujuan dengan inputan dari request
        $data->update([
            'persetujuan' => $request->persetujuan2,
        ]);

        return redirect()->back()->with('success', 'Field persetujuan berhasil diupdate.');
    }
}
