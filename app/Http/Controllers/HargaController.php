<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use TCPDF;
use DOMDocument;
use DOMXPath;

class HargaController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = 'https://logam-mulia-api.vercel.app/prices/hargaemas-com'; // URL API baru

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            $date = $response->getHeader('Date')[0];
            $emas = Harga::all();

            // Memeriksa apakah data harga emas tersedia
            if (isset($data['data'][0]['sell']) && isset($data['data'][0]['buy'])) {
                $sellPrice = $data['data'][0]['sell'];  // Harga jual
                $buybackPrice = $data['data'][0]['buy'];  // Harga beli (buyback)

                // Karena tidak ada "date" di dalam response, kita dapat menggunakan nilai lain jika diperlukan, 
                // atau mengabaikan jika tidak ada informasi tanggal.// Anda dapat menggantinya sesuai dengan kebutuhan Anda

                // Mengirim data ke view
                return view('menu.harga.index', [
                    'sellPrice' => $sellPrice,
                    'buybackPrice' => $buybackPrice,
                    'lastUpdated' => $date,
                    'emas' => $emas,
                ]);
            }


            // Jika data tidak ditemukan
            return view('menu.harga.index', [
                'error' => 'Harga emas Antam tidak ditemukan.',
            ]);
        } catch (\Exception $e) {
            return view('menu.harga.index', [
                'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'date' => 'required|date',  // Validasi sebagai tanggal
            'buy' => 'required|numeric', // Validasi sebagai angka
            'sell' => 'required|numeric', // Validasi sebagai angka
        ]);

        // Menyimpan data harga emas ke database
        $harga = new Harga();
        $harga->date = $validated['date']; // Tanggal terakhir update
        $harga->buy_price = $validated['buy'];   // Harga beli (buyback)
        $harga->sell_price = $validated['sell']; // Harga jual

        // Menghitung harga untuk 5g, 10g, 25g, 50g, 100g
        $harga->harga5 = $validated['sell'] * 5;
        $harga->harga10 = $validated['sell'] * 10;
        $harga->harga25 = $validated['sell'] * 25;
        $harga->harga50 = $validated['sell'] * 50;
        $harga->harga100 = $validated['sell'] * 100;

        // Menyimpan data ke database
        $harga->save();

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('harga.index')->with('success', 'Data Harga Emas Berhasil Disimpan.');
    }

    public function destroy($id)
    {
        $cilem = Harga::findOrFail($id);
        $cilem->delete();

        return redirect()->route('harga.index')->with('success', 'Data Harga Emas berhasil dihapus.');
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
        $query = Harga::query();

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
        $pdf->SetTitle('Laporan Harga');
        $pdf->SetHeaderData('', 0, 'Laporan Harga', $filterTitle);
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        // Header tabel
        $html = '<h2 style="text-align:center;">' . $filterTitle . '</h2>';
        $pdf->SetFont('helvetica', 'B', 7); // Bold, ukuran 12
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr style="background-color:#f2f2f2;">
                            <th>Tanggal</th>
                            <th>Harga Jual</th>
                            <th>Harga beli</th>
                            <th>Harga / 5 gram</th>
                            <th>Harga / 10 gram</th>
                            <th>Harga / 25 gram</th>
                            <th>Harga / 50 gram</th>
                            <th>Harga / 100 gram</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($data as $row) {
            $html .= '<tr>
                        <td>' . date('d M Y', strtotime($row->date)) . '</td>
                        <td>Rp ' . number_format($row->buy_price, 0, ',', '.') . '</td>
                        <td>Rp ' . number_format($row->sell_price, 0, ',', '.') . '</td>
                        <td>Rp ' . number_format($row->harga5, 0, ',', '.') . '</td>
                        <td>Rp ' . number_format($row->harga10, 0, ',', '.') . '</td>
                        <td>Rp ' . number_format($row->harga25, 0, ',', '.') . '</td>
                        <td>Rp ' . number_format($row->harga50, 0, ',', '.') . '</td>
                        <td>Rp ' . number_format($row->harga100, 0, ',', '.') . '</td>
                    </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Simpan atau tampilkan PDF
        $pdf->Output('laporan_harga.pdf', 'D'); // 'D' = download otomatis, 'I' = tampil di browser
    }
}
