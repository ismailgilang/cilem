<?php

namespace App\Http\Controllers;

use App\Models\Cilem;
use App\Models\Harga;
use Illuminate\Http\Request;
use TCPDF;

class CilemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cilem::all();
        return view('menu.cilem.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Harga::latest()->first();
        return view('menu.cilem.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'banyak' => 'required|string',
            'angsuran' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'banyak.required' => 'Ceklist Pilih Belum diisi.',
            'angsuran.required' => 'Ceklist angsuran belum diisi.',
        ]);

        // Simpan ke database
        Cilem::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'banyak' => $request->banyak,
            'harga_asli' => $request->harga_asli,
            'uang_muka' => $request->uang_muka,
            'pembiayaan' => $request->pembiayaan,
            'adm' => $request->adm,
            'tot_adm' => $request->tot_adm,
            'angsuran' => $request->angsuran,
            'bayar_angsuran' => $request->bayar_angsuran,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('cilem.index')->with('success', 'Data Cicil Emas berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Cilem::findOrFail($id);
        $data = Harga::latest()->first();
        return view('menu.cilem.edit', compact('data', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'banyak' => 'required|string',
            'angsuran' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'banyak.required' => 'Ceklist Pilih Belum diisi.',
            'angsuran.required' => 'Ceklist angsuran belum diisi.',
        ]);
        $data = Cilem::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('cilem.index')->with('success', 'Data Cicil Emas berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cilem = Cilem::findOrFail($id);
        $cilem->delete();

        return redirect()->route('cilem.index')->with('success', 'Data Cicil Emas berhasil dihapus.');
    }

    public function cetak(Request $request)
    {
        $bulan = $request->bulan; // Format: YYYY-MM
        $tahun = $request->tahun; // Format: YYYY

        // Validasi hanya salah satu yang boleh diisi
        if (!$bulan && !$tahun) {
            return back()->with('error', 'Pilih bulan atau tahun.');
        }
        if ($bulan && $tahun) {
            return back()->with('error', 'Pilih salah satu, tidak boleh dua-duanya.');
        }

        // Query data berdasarkan filter
        $query = Cilem::query();

        if ($bulan) {
            $query->whereYear('created_at', substr($bulan, 0, 4)) // Pastikan pakai created_at
                ->whereMonth('created_at', substr($bulan, 5, 2));
            $filterTitle = "Laporan Bulan " . date('F Y', strtotime($bulan));
        } else {
            $query->whereYear('created_at', $tahun); // Pakai created_at juga di sini
            $filterTitle = "Laporan Tahun " . $tahun;
        }

        $data = $query->get();

        // Buat objek TCPDF
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Laporan Cilem');
        $pdf->SetHeaderData('', 0, 'Laporan Cilem', $filterTitle);
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        // Header tabel
        $html = '<h2 style="text-align:center;">' . $filterTitle . '</h2>';
        $pdf->SetFont('helvetica', 'B', 7); // Bold, ukuran 12
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr style="background-color:#f2f2f2;">
                            <th style="text-align:center;" >Tanggal</th>
                            <th style="text-align:center;">Nama</th>
                            <th style="text-align:center;">NIK</th>
                            <th style="text-align:center;">Banyak Emas</th>
                            <th style="text-align:center;">Harga / Gram</th>
                            <th style="text-align:center;">Uang Muka</th>
                            <th style="text-align:center;">Pembiayaan</th>
                            <th style="text-align:center;">Admin</th>
                            <th style="text-align:center;">Total Admin</th>
                            <th style="text-align:center;">Lama Angsuran</th>
                            <th style="text-align:center;">Bayar angsuran</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($data as $row) {
            $html .= '<tr>
                        <td style="text-align:center;">' . date('d M Y', strtotime($row->date)) . '</td>
                        <td style="text-align:center;">' . $row->name . '</td>
                        <td style="text-align:center;">' . $row->nik . '</td>
                        <td style="text-align:center;">' . $row->banyak . '</td>
                        <td style="text-align:center;">' . $row->harga_asli . '</td>
                        <td style="text-align:center;">' . $row->uang_muka . '</td>
                        <td style="text-align:center;">' . $row->pembiayaan . '</td>
                        <td style="text-align:center;">' . $row->adm . '</td>
                        <td style="text-align:center;">' . $row->tot_adm . '</td>
                        <td style="text-align:center;">' . $row->angsuran . '</td>
                        <td style="text-align:center;">' . $row->bayar_angsuran . '</td>
                    </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Simpan atau tampilkan PDF
        $pdf->Output('laporan_harga.pdf', 'I'); // 'D' = download otomatis, 'I' = tampil di browser
    }
}
