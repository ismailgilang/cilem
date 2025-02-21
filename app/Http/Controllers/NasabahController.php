<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Http\Request;
use TCPDF;

class NasabahController extends Controller
{
    public function index()
    {
        $data = Nasabah::all();
        $user = User::where('role', 'nasabah')->get();
        return view('menu.nasabah.index', compact('data', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nik'           => 'required|string|max:255',
            'cif'           => 'required|string|max:255',
            'name'          => 'required|string|max:255',
            'portofolio'    => 'nullable|string',
            'penempatan'    => 'required|string',  // sesuaikan rule jika perlu numeric atau format tertentu
            'dana'          => 'required|string',
            'waktu'         => 'required|string',
            'tanggal'       => 'required|date',
            'ajuan_nisbah'  => 'required|string',
            'nisbah_rate'  => 'required|string',
            'status'  => 'required|string',
        ], [
            'cif.required'           => 'NIK Harus Dipilih',
            'cif.required'           => 'CIF Wajib Diisi',
            'name.required'          => 'Nama Wajib Diisi',
            'portofolio.required'    => 'portofolio Wajib Diisi',
            'penempatan.required'    => 'Nominal Penempatan Wajib Diisi',  // sesuaikan rule jika perlu numeric atau format tertentu
            'dana.required'          => 'Asal Dana Wajib Diisi',
            'waktu.required'         => 'Jangka Waktu Wajib Diisi',
            'tanggal.required'       => 'Tanggal Penempatan Wajib Diisi',
            'ajuan_nisbah.required'  => 'Nisbah Diajukan Wajib Diisi',
            'nisbah_rate.required'  => 'Nisbah Rate Wajib Diisi',
            'status.required'  => 'Nisbah Disetujui Wajib Diisi',

        ]);

        // Simpan ke database
        Nasabah::create([
            'nik' => $request->nik,
            'cif' => $request->cif,
            'name' => $request->name,
            'portofolio' => $request->portofolio,
            'penempatan' => $request->penempatan,
            'dana' => $request->dana,
            'waktu' => $request->waktu,
            'tanggal' => $request->tanggal,
            'ajuan_nisbah' => $request->ajuan_nisbah,
            'nisbah_rate' => $request->nisbah_rate,
            'status' => $request->status,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('nasabah.index')->with('success', 'Data Nasabah berhasil disimpan.');
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
        $nasabah = Nasabah::findOrFail($id);
        $user = User::where('role', 'nasabah')->get();
        return view('menu.nasabah.edit', compact('nasabah', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik'           => 'required|string|max:255',
            'cif'           => 'required|string|max:255',
            'name'          => 'required|string|max:255',
            'portofolio'    => 'required|string',
            'penempatan'    => 'required|string',
            'dana'          => 'required|string',
            'waktu'         => 'required|string',
            'tanggal'       => 'required|date',
            'ajuan_nisbah'  => 'required|string',
        ]);
        $data = Nasabah::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('nasabah.index')->with('success', 'Data Nasabah berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cilem = Nasabah::findOrFail($id);
        $cilem->delete();

        return redirect()->route('nasabah.index')->with('success', 'Data Nasabah berhasil dihapus.');
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
        $query = Nasabah::query();

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
                            <th style="text-align:center;">CIF</th>
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
                        <td style="text-align:center;">' . $row->cif . '</td>
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
        $pdf->Output('laporan_harga.pdf', 'D'); // 'D' = download otomatis, 'I' = tampil di browser
    }
}
