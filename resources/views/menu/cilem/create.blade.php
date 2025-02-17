<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Buat Data Cicil Emas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-6">


                        <div class="overflow-x-auto shadow-md sm:rounded-lg mt-4">
                            <table class="table-auto w-full border-collapse border border-gray-300 bg-white">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th rowspan="2" class="border border-gray-300 whitespace-nowrap px-4 py-2">#</th>
                                        <th rowspan="2" class="border border-gray-300 whitespace-nowrap px-4 py-2">Nama</th>
                                        <th rowspan="2" class="border border-gray-300 whitespace-nowrap px-4 py-2">NIK</th>
                                        <th rowspan="2" class="border border-gray-300 whitespace-nowrap px-4 py-2">Pilih</th>
                                        <th rowspan="2" class="border border-gray-300 whitespace-nowrap px-4 py-2">Banyak gram</th>
                                        <th rowspan="2" class="border border-gray-300 whitespace-nowrap px-4 py-2">Harga</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2">Uang Muka</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2">Pembiayaan</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2">Adm</th>
                                        <th rowspan="2" class="border border-gray-300 whitespace-nowrap px-4 py-2">Total dp + adm</th>
                                        <th colspan="5" class="border border-gray-300 whitespace-nowrap px-4 py-2">Angsuran Perbulan</th>
                                    </tr>
                                    <tr>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2">5%</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2">95%</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2">0,25%</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2" id="angsuran1"><input type="checkbox" class="angsuran-group" name="" id="pilih_angsuran1"> 1 Tahun</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2" id="angsuran2"><input type="checkbox" class="angsuran-group" name="" id="pilih_angsuran2"> 2 Tahun</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2" id="angsuran3"><input type="checkbox" class="angsuran-group" name="" id="pilih_angsuran3"> 3 Tahun</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2" id="angsuran4"><input type="checkbox" class="angsuran-group" name="" id="pilih_angsuran4"> 4 Tahun</th>
                                        <th class="border border-gray-300 whitespace-nowrap px-4 py-2" id="angsuran5"><input type="checkbox" class="angsuran-group" name="" id="pilih_angsuran5"> 5 Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5" class="border border-gray-300 whitespace-nowrap px-4 py-2 text-center">1</td>
                                        <td rowspan="5" class="border border-gray-300 whitespace-nowrap px-4 py-2"><input type="text" id="nama-input" class="w-100 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></td>
                                        <td rowspan="5" class="border border-gray-300 whitespace-nowrap px-4 py-2"><input type="text" id="nik-input" class="w-100 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-center"><input type="checkbox" id="cek5" class="checkbox-group"></td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-banyak">5</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-hargaasli">Rp {{ number_format($data->harga5, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-uang_muka">Rp {{ number_format($data->harga5 * 0.05, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-pembiayaan">Rp {{ number_format($data->harga5 * 0.95, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-adm">Rp {{ number_format($data->harga5 * 0.95 * 0.0025, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-tot_adm">Rp {{ number_format($data->harga5 * 0.05 + $data->harga5 * 0.95 * 0.0025, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-bayar_angsuran1">Rp {{ number_format($data->harga5 * 0.95 / 12 + $data->harga5 * 0.95 * 0.0522 / 12 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-bayar_angsuran2">Rp {{ number_format((($data->harga5 * 0.95) / 24) + (($data->harga5 * 0.95 ) * 0.051) / 24, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-bayar_angsuran3">Rp {{ number_format($data->harga5 * 0.95 / 36 + $data->harga5 * 0.95 * 0.051 / 36 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-bayar_angsuran4">Rp {{ number_format($data->harga5 * 0.95 / 48 + $data->harga5 * 0.95 * 0.0514 / 48 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="5-bayar_angsuran5">Rp {{ number_format($data->harga5 * 0.95 / 60 + $data->harga5 * 0.95 * 0.052 / 60 , 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-center"><input type="checkbox" id="cek10" class="checkbox-group"></td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-banyak">10</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-hargaasli">Rp {{ number_format($data->harga10, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-uang_muka">Rp {{ number_format($data->harga10 * 0.05, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-pembiayaan">Rp {{ number_format($data->harga10 * 0.95, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-adm">Rp {{ number_format($data->harga10 * 0.0025, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-tot_adm">Rp {{ number_format($data->harga10 * 0.0025 + $data->harga10 * 0.05 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-bayar_angsuran1">Rp {{ number_format($data->harga10 * 0.95 / 12 + $data->harga10 * 0.95 * 0.0522 / 12 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-bayar_angsuran2">Rp {{ number_format((($data->harga10 * 0.95) / 24) + (($data->harga10 * 0.95 ) * 0.051) / 24, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-bayar_angsuran3">Rp {{ number_format($data->harga10 * 0.95 / 36 + $data->harga10 * 0.95 * 0.051 / 36 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-bayar_angsuran4">Rp {{ number_format($data->harga10 * 0.95 / 48 + $data->harga10 * 0.95 * 0.0514 / 48 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="10-bayar_angsuran5">Rp {{ number_format($data->harga10 * 0.95 / 60 + $data->harga10 * 0.95 * 0.052 / 60 , 0, ',', '.') }}</td>

                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-center"><input type="checkbox" id="cek25" class="checkbox-group"></td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-banyak">25</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-hargaasli">Rp {{ number_format($data->harga25, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-uang_muka">Rp {{ number_format($data->harga25 * 0.05, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-pembiayaan">Rp {{ number_format($data->harga25 * 0.95, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-adm">Rp {{ number_format($data->harga25 * 0.0025, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-tot_adm">Rp {{ number_format($data->harga25 * 0.0025 + $data->harga25 * 0.05 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-bayar_angsuran1">Rp {{ number_format($data->harga25 * 0.95 / 12 + $data->harga25 * 0.95 * 0.0522 / 12 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-bayar_angsuran2">Rp {{ number_format((($data->harga25 * 0.95) / 24) + (($data->harga25 * 0.95 ) * 0.051) / 24, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-bayar_angsuran3">Rp {{ number_format($data->harga25 * 0.95 / 36 + $data->harga25 * 0.95 * 0.051 / 36 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-bayar_angsuran4">Rp {{ number_format($data->harga25 * 0.95 / 48 + $data->harga25 * 0.95 * 0.0514 / 48 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="25-bayar_angsuran5">Rp {{ number_format($data->harga25 * 0.95 / 60 + $data->harga25 * 0.95 * 0.052 / 60 , 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-center"><input type="checkbox" id="cek50" class="checkbox-group"></td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-banyak">50</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-hargaasli">Rp {{ number_format($data->harga50, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-uang_muka">Rp {{ number_format($data->harga50 * 0.05, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-pembiayaan">Rp {{ number_format($data->harga50 * 0.95, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-adm">Rp {{ number_format($data->harga50 * 0.0025, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-tot_adm">Rp {{ number_format($data->harga50 * 0.0025 + $data->harga50 * 0.05 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-bayar_angsuran1">Rp {{ number_format($data->harga50 * 0.95 / 12 + $data->harga50 * 0.95 * 0.0522 / 12 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-bayar_angsuran2">Rp {{ number_format((($data->harga50 * 0.95) / 24) + (($data->harga50 * 0.95 ) * 0.051) / 24, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-bayar_angsuran3">Rp {{ number_format($data->harga50 * 0.95 / 36 + $data->harga50 * 0.95 * 0.051 / 36 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-bayar_angsuran4">Rp {{ number_format($data->harga50 * 0.95 / 48 + $data->harga50 * 0.95 * 0.0514 / 48 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="50-bayar_angsuran5">Rp {{ number_format($data->harga50 * 0.95 / 60 + $data->harga50 * 0.95 * 0.052 / 60 , 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-center"><input type="checkbox" id="cek100" class="checkbox-group"></td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-banyak">100</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-hargaasli">Rp {{ number_format($data->harga100, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-uang_muka">Rp {{ number_format($data->harga100 * 0.05, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-pembiayaan">Rp {{ number_format($data->harga100 * 0.95, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-adm">Rp {{ number_format($data->harga100 * 0.0025, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-tot_adm">Rp {{ number_format($data->harga100 * 0.0025 + $data->harga100 * 0.05 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-bayar_angsuran1">Rp {{ number_format($data->harga100 * 0.95 / 12 + $data->harga100 * 0.95 * 0.0522 / 12 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-bayar_angsuran2">Rp {{ number_format((($data->harga100 * 0.95) / 24) + (($data->harga100 * 0.95 ) * 0.051) / 24, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-bayar_angsuran3">Rp {{ number_format($data->harga100 * 0.95 / 36 + $data->harga100 * 0.95 * 0.051 / 36 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-bayar_angsuran4">Rp {{ number_format($data->harga100 * 0.95 / 48 + $data->harga100 * 0.95 * 0.0514 / 48 , 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 whitespace-nowrap px-4 py-2 text-left" id="100-bayar_angsuran5">Rp {{ number_format($data->harga100 * 0.95 / 60 + $data->harga100 * 0.95 * 0.052 / 60 , 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-end mt-4">
                            <form action="{{route('cilem.store')}}" method="post" class="w-full">
                                @csrf
                                <input type="hidden" required id="name" name="name">
                                <input type="hidden" required id="nik" name="nik">
                                <input type="hidden" required id="banyak" name="banyak">
                                <input type="hidden" required id="harga_asli" name="harga_asli">
                                <input type="hidden" required id="uang_muka" name="uang_muka">
                                <input type="hidden" required id="pembiayaan" name="pembiayaan">
                                <input type="hidden" required id="adm" name="adm">
                                <input type="hidden" required id="tot_adm" name="tot_adm">
                                <input type="hidden" required id="angsuran" name="angsuran">
                                <input type="hidden" required id="bayar_angsuran" name="bayar_angsuran">
                                <div class="flex w-full justify-between">
                                    <a href="{{route('cilem.index')}}" class="px-2 py-2 bg-red-500 rounded-md hover:bg-red-600 text-white">Kembali</a>
                                    <button type="submit" class="bg-blue-500 text-white rounded-md px-2 py-2">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let checkboxes = document.querySelectorAll(".checkbox-group");
            let angsuranCheckboxes = document.querySelectorAll(".angsuran-group");

            // Event untuk memilih hanya satu checkbox utama
            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener("change", function() {
                    if (this.checked) {
                        // Uncheck semua checkbox kecuali yang dipilih
                        checkboxes.forEach((cb) => {
                            if (cb !== this) cb.checked = false;
                        });

                        // Ambil angka ID dari checkbox (misal: cek5 → 5, cek10 → 10, dll.)
                        let idNumber = this.id.replace("cek", "");

                        // Ambil nilai dari tabel dan masukkan ke input tersembunyi
                        document.querySelector("#banyak").value = document.querySelector(`[id='${idNumber}-banyak']`).textContent.trim();
                        document.querySelector("#harga_asli").value = document.querySelector(`[id='${idNumber}-hargaasli']`).textContent.replace().trim();
                        document.querySelector("#uang_muka").value = document.querySelector(`[id='${idNumber}-uang_muka']`).textContent.replace().trim();
                        document.querySelector("#pembiayaan").value = document.querySelector(`[id='${idNumber}-pembiayaan']`).textContent.replace().trim();
                        document.querySelector("#adm").value = document.querySelector(`[id='${idNumber}-adm']`).textContent.replace().trim();
                        document.querySelector("#tot_adm").value = document.querySelector(`[id='${idNumber}-tot_adm']`).textContent.replace().trim();

                        // Simpan ID yang dipilih untuk digunakan saat memilih angsuran
                        document.querySelector("#angsuran").dataset.selectedId = idNumber;
                    } else {
                        // Reset semua input jika tidak ada yang dipilih
                        document.querySelectorAll("input[type='hidden']").forEach(input => input.value = "");
                    }
                });
            });

            // Event untuk memilih hanya satu angsuran
            angsuranCheckboxes.forEach((angsuranCheckbox) => {
                angsuranCheckbox.addEventListener("change", function() {
                    if (this.checked) {
                        // Uncheck semua angsuran lain
                        angsuranCheckboxes.forEach((cb) => {
                            if (cb !== this) cb.checked = false;
                        });

                        // Ambil nomor angsuran dari ID (misal: pilih_angsuran1 → 1, pilih_angsuran2 → 2, dll.)
                        let angsuranNumber = this.id.replace("pilih_angsuran", "");
                        let selectedId = document.querySelector("#angsuran").dataset.selectedId;

                        // Masukkan nilai ke input tersembunyi
                        document.querySelector("#angsuran").value = document.querySelector(`[id='angsuran${angsuranNumber}']`).textContent.trim();
                        document.querySelector("#bayar_angsuran").value = document.querySelector(`[id='${selectedId}-bayar_angsuran${angsuranNumber}']`).textContent.replace().trim();
                    } else {
                        // Reset input angsuran jika tidak ada yang dipilih
                        document.querySelector("#angsuran").value = "";
                        document.querySelector("#bayar_angsuran").value = "";
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let namaInput = document.querySelector("#nama-input");
            let nameInput = document.querySelector("input[name='name']");
            let nikInput = document.querySelector("#nik-input");
            let nik1Input = document.querySelector("input[name='nik']");

            // Event listener untuk mengisi input name berdasarkan nama-input
            namaInput.addEventListener("input", function() {
                nameInput.value = this.value;
            });
            nikInput.addEventListener("input", function() {
                nik1Input.value = this.value;
            });
        });
    </script>
</x-app-layout>