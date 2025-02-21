<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Riwayat Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Pilihan Dokumen -->
                    <div class="container mx-auto p-6">
                        <label for="docSelect" class="block text-sm font-medium text-gray-700">Pilih Dokumen:</label>
                        <select id="docSelect" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="cicil">Riwayat Laporan Cicil Emas</option>
                            <option value="harga">Riwayat Laporan Harga Emas</option>
                        </select>
                    </div>

                    <!-- Section Riwayat Laporan Cicil Emas -->
                    <div id="sectionCicil" class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <div class="container mx-auto p-6">
                                        <h1 class="text-3xl font-bold mb-6">Riwayat Laporan Cicil Emas</h1>
                                        <div class="flex justify-between items-center">
                                            <div class="flex flex-col md:flex-row gap-4 mb-4">
                                                <!-- Input Text -->
                                                <input type="text" id="searchInput" onkeyup="filterTable('cicil')"
                                                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                    placeholder="Cari Data...">
                                                <input type="date" id="searchDate" onchange="filterTable('cicil')"
                                                    class="px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                            </div>
                                            <div class="flex-col md:flex-row gap-4 mb-4">
                                                <button type="button"
                                                    class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-500 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                                    x-data x-on:click="$dispatch('open-modal', 'add-area-modal')">
                                                    Cetak
                                                </button>
                                            </div>
                                        </div>
                                        <div class="overflow-x-auto shadow-md sm:rounded-lg mt-4">
                                            <table class="min-w-full table-auto" id="tableCicil">
                                                <thead>
                                                    <tr class="bg-yellow-500">
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">#</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Name</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Nik</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Banyak Gram</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Harga</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Uang Muka</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Pembiayaan</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Adm</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Total dp + Adm</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Lama Angsuran</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Harga Angsuran</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Dibuat Pada</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableBodyCicil">
                                                    @foreach($data as $e)
                                                    <tr class="bg-white border-b hover:bg-gray-100">
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center">{{$loop->iteration}}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center">{{ $e->name }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->nik }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->banyak }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->harga_asli }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->uang_muka }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->pembiayaan }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->adm }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->tot_adm }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->angsuran }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->bayar_angsuran }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->created_at }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <p id="noResultCicil" class="text-center text-gray-500 mt-4 hidden">❌ Data tidak ditemukan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Riwayat Laporan Harga Emas -->
                    <div id="sectionHarga" class="py-12" style="display: none;">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <div class="container mx-auto p-6">
                                        <h1 class="text-3xl font-bold mb-6">Riwayat Laporan Harga Emas</h1>
                                        <div class="flex justify-between items-center">
                                            <div class="flex flex-col md:flex-row gap-4 mb-4">
                                                <!-- Input Text -->
                                                <input type="text" id="searchInput2" onkeyup="filterTable('harga')"
                                                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                    placeholder="Cari Data...">
                                                <input type="date" id="searchDate2" onchange="filterTable('harga')"
                                                    class="px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                            </div>
                                            <div class="flex-col md:flex-row gap-4 mb-4">
                                                <button type="button"
                                                    class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-500 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                                    x-data x-on:click="$dispatch('open-modal', 'add-area-modal1')">
                                                    Cetak
                                                </button>
                                            </div>
                                        </div>
                                        <div class="overflow-x-auto shadow-md sm:rounded-lg mt-4">
                                            <table class="min-w-full table-auto" id="tableHarga">
                                                <thead>
                                                    <tr class="bg-yellow-500">
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">#</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Tanggal Terakhir Update</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Buy</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Sell</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">5 gram</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">10 gram</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">25 gram</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">50 gram</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">100 gram</th>
                                                        <th class="px-4 py-2 text-center text-sm font-semibold text-white whitespace-nowrap">Di Save Pada</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableBodyHarga">
                                                    @foreach($emas as $e)
                                                    <tr class="bg-white border-b hover:bg-gray-100">
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center">{{$loop->iteration}}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center">{{ $e->date }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">Rp {{ number_format($e->buy_price, 0, ',', '.') }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">Rp {{ number_format($e->sell_price, 0, ',', '.') }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">Rp {{ number_format($e->harga5, 0, ',', '.') }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">Rp {{ number_format($e->harga10, 0, ',', '.') }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">Rp {{ number_format($e->harga25, 0, ',', '.') }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">Rp {{ number_format($e->harga50, 0, ',', '.') }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">Rp {{ number_format($e->harga100, 0, ',', '.') }}</td>
                                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 text-center whitespace-nowrap">{{ $e->created_at }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <p id="noResultHarga" class="text-center text-gray-500 mt-4 hidden">❌ Data tidak ditemukan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="add-area-modal1" focusable>
        <form action="{{route('cetak.harga')}}" method="POST" class="p-6">
            @csrf
            <h2 class="text-lg font-bold text-black">
                Cetak Harga ( Pilih Salah Satu )
            </h2>

            <div class="mt-4">
                <label for="bulan" class="block text-sm font-medium text-black">Bulan</label>
                <input type="month" name="bulan" id="bulan"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                    onchange="disableOtherInput('bulan')">
            </div>

            <!-- Input Tahun -->
            <div class="mt-4">
                <label for="tahun" class="block text-sm font-medium text-black">Tahun</label>
                <input type="number" name="tahun" id="tahun"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                    min="2000" max="2099" step="1"
                    placeholder="Masukkan Tahun (YYYY)"
                    onchange="disableOtherInput('tahun')">
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>
                <x-primary-button class="ml-3">
                    Simpan
                </x-primary-button>
            </div>
        </form>
    </x-modal>
    <x-modal name="add-area-modal" focusable>
        <form action="{{route('cetak.cilem')}}" method="POST" class="p-6">
            @csrf
            <h2 class="text-lg font-bold text-black">
                Cetak Cicil Emas ( Gunakan Salah Satu )
            </h2>

            <div class="mt-4">
                <label for="bulan" class="block text-sm font-medium text-black">Bulan</label>
                <input type="month" name="bulan" id="bulan"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                    onchange="disableOtherInput('bulan')">
            </div>

            <!-- Input Tahun -->
            <div class="mt-4">
                <label for="tahun" class="block text-sm font-medium text-black">Tahun</label>
                <input type="number" name="tahun" id="tahun"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                    min="2000" max="2099" step="1"
                    placeholder="Masukkan Tahun (YYYY)"
                    onchange="disableOtherInput('tahun')">
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>
                <x-primary-button class="ml-3">
                    Simpan
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- Script JavaScript untuk mengatur tampilan kedua tabel dan filtering -->
    <script>
        // Pilihan dokumen
        document.getElementById('docSelect').addEventListener('change', function() {
            var value = this.value;
            if (value === 'cicil') {
                document.getElementById('sectionCicil').style.display = 'block';
                document.getElementById('sectionHarga').style.display = 'none';
            } else if (value === 'harga') {
                document.getElementById('sectionCicil').style.display = 'none';
                document.getElementById('sectionHarga').style.display = 'block';
            }
        });

        // Contoh fungsi filter sederhana (sesuaikan dengan kebutuhan)
        function filterTable(section) {
            var searchInput, searchDate, filterText, filterDate, table, tbody, rows, i, j, cellText, rowContainsText;
            if (section === 'cicil') {
                searchInput = document.getElementById("searchInput").value.toLowerCase();
                searchDate = document.getElementById("searchDate").value;
                table = document.getElementById("tableCicil");
                tbody = document.getElementById("tableBodyCicil");
            } else if (section === 'harga') {
                searchInput = document.getElementById("searchInput2").value.toLowerCase();
                searchDate = document.getElementById("searchDate2").value;
                table = document.getElementById("tableHarga");
                tbody = document.getElementById("tableBodyHarga");
            }
            rows = tbody.getElementsByTagName("tr");
            var foundAny = false;
            for (i = 0; i < rows.length; i++) {
                rowContainsText = false;
                // Cek semua cell dalam baris
                var cells = rows[i].getElementsByTagName("td");
                for (j = 0; j < cells.length; j++) {
                    cellText = cells[j].textContent.toLowerCase();
                    if (cellText.indexOf(searchInput) > -1) {
                        rowContainsText = true;
                        break;
                    }
                }
                // Jika ada input date, asumsikan kolom terakhir mengandung tanggal (sesuaikan index jika perlu)
                if (searchDate) {
                    var dateCell = cells[cells.length - 1].textContent;
                    if (dateCell.indexOf(searchDate) === -1) {
                        rowContainsText = false;
                    }
                }
                if (rowContainsText) {
                    rows[i].style.display = "";
                    foundAny = true;
                } else {
                    rows[i].style.display = "none";
                }
            }
            // Tampilkan pesan jika tidak ada hasil
            if (section === 'cicil') {
                document.getElementById("noResultCicil").style.display = foundAny ? "none" : "block";
            } else if (section === 'harga') {
                document.getElementById("noResultHarga").style.display = foundAny ? "none" : "block";
            }
        }
    </script>
    <script>
        function disableOtherInput(selected) {
            if (selected === 'bulan') {
                document.getElementById('tahun').value = ''; // Kosongkan tahun jika bulan dipilih
            } else {
                document.getElementById('bulan').value = ''; // Kosongkan bulan jika tahun dipilih
            }
        }
    </script>
</x-app-layout>