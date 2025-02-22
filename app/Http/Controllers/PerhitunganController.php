<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PerhitunganController extends Controller
{
    public function index()
    {
        $query = Nasabah::query()
            ->whereRaw("CAST(REPLACE(REPLACE(portofolio, 'Rp ', ''), '.', '') AS UNSIGNED) > ?", [400000000]);

        // Jika role user, filter berdasarkan nik yang sama dengan user yang login
        if (Auth::user()->role === 'nasabah') {
            $query->where('nik', Auth::user()->nik);
        }

        $data = $query->get();

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
    public function cetak($id)
    {
        // Ambil record Nasabah berdasarkan id
        $nasabah = Nasabah::findOrFail($id);

        // Inisialisasi TCPDF (orientasi Landscape)
        $pdf = new \TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Laporan Nasabah');
        $pdf->SetHeaderData('', 0, 'Laporan Nasabah', 'Data Nasabah NIK: ' . $nasabah->nik . " " . 'CIF' . ": " . $nasabah->cif);
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        // Set font header tabel
        $pdf->SetFont('helvetica', 'B', 7);

        // Buat konten HTML untuk tabel PDF
        $html = '';
        $html .= '<table border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#f2f2f2;">
                        <th style="text-align:center;">Name</th>
                        <th style="text-align:center;">Nik</th>
                        <th style="text-align:center;">CIF</th>
                        <th style="text-align:center;">Portofolio</th>
                        <th style="text-align:center;">Penempatan</th>
                        <th style="text-align:center;">Dana</th>
                        <th style="text-align:center;">Waktu</th>
                        <th style="text-align:center;">Tanggal</th>
                        <th style="text-align:center;">Ajuan Nisbah</th>
                        <th style="text-align:center;">Nisbah Rate</th>
                        <th style="text-align:center;">Status</th>
                        <th style="text-align:center;">Persetujuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;">' . $nasabah->name . '</td>
                        <td style="text-align:center;">' . $nasabah->nik . '</td>
                        <td style="text-align:center;">' . $nasabah->cif . '</td>
                        <td style="text-align:center;">' . $nasabah->portofolio . '</td>
                        <td style="text-align:center;">' . $nasabah->penempatan . '</td>
                        <td style="text-align:center;">' . $nasabah->dana . '</td>
                        <td style="text-align:center;">' . $nasabah->waktu . '</td>
                        <td style="text-align:center;">' . $nasabah->tanggal . '</td>
                        <td style="text-align:center;">' . $nasabah->ajuan_nisbah . '</td>
                        <td style="text-align:center;">' . $nasabah->nisbah_rate . '</td>
                        <td style="text-align:center;">' . $nasabah->status . '</td>
                        <td style="text-align:center;">' . $nasabah->persetujuan . '</td>
                    </tr>
                </tbody>
            </table>';

        // Tulis HTML ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF ke browser dengan mode download ('D') atau tampilkan di browser ('I')
        $pdf->Output('laporan_nasabah.pdf', 'I');
    }
}
