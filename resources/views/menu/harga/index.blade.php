<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Harga Emas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-6">
                        <h1 class="text-3xl font-bold mb-6">Harga Emas Antam</h1>

                        <!-- Data Card for other information -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                            <!-- Card for Sell Price -->
                            <div class="bg-blue-500 p-4 rounded-lg shadow-md text-white">
                                <h2 class="text-xl font-semibold mb-2">Harga Jual</h2>
                                <p class="text-2xl font-bold">Rp {{ number_format($sellPrice, 0, ',', '.') }}</p>
                            </div>

                            <!-- Card for Buyback Price -->
                            <div class="bg-green-500 p-4 rounded-lg shadow-md text-white">
                                <h2 class="text-xl font-semibold mb-2">Harga Beli (Buyback)</h2>
                                <p class="text-2xl font-bold">Rp {{ number_format($buybackPrice, 0, ',', '.') }}</p>
                            </div>

                            <!-- Card for Last Updated -->
                            <div class="bg-gray-500 p-4 rounded-lg shadow-md text-white">
                                <h2 class="text-xl font-semibold mb-2">Terakhir Update</h2>
                                <p class="text-lg">{{ $lastUpdated }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex flex-col md:flex-row gap-4 mb-4">
                                <!-- Input Text -->
                                <input type="text" id="searchInput" onkeyup="filterTable()"
                                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    placeholder="Cari Data...">

                                <input type="date" id="searchDate" onchange="filterTable()"
                                    class="px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="flex flex-col md:flex-row gap-4 mb-4">
                                <form action="{{route('harga.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="date" value="{{ $lastUpdated }}">
                                    <input type="hidden" name="buy" value="{{ $buybackPrice}}">
                                    <input type="hidden" name="sell" value="{{ $sellPrice }}">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 rounded-md text-white px-2 py-2">Update Data</button>
                                </form>
                                <button type="button"
                                    class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-500 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    x-data x-on:click="$dispatch('open-modal', 'add-area-modal')">
                                    Cetak
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto shadow-md sm:rounded-lg mt-4">
                            <table class="min-w-full table-auto" id="myTable">
                                <thead>
                                    <tr class="bg-yellow-500">
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">#</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Tanggal Terakhir Update</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Buy</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Sell</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">5 gram</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">10 gram</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">25 gram</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">50 gram</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">100 gram</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Di Save Pada</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Tolls</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($emas as $e)
                                    <tr class="bg-white border-b hover:bg-gray-100">
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700">{{$loop->iteration}}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700">{{ $e->date }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">Rp {{ number_format($e->buy_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">Rp {{ number_format($e->sell_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">Rp {{ number_format($e->harga5, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">Rp {{ number_format($e->harga10, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">Rp {{ number_format($e->harga25, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">Rp {{ number_format($e->harga50 , 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">Rp {{ number_format($e->harga100, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->created_at }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700">
                                            <div class="flex gap-2">
                                                <form action="{{route('harga.destroy', $e->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-delete px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md" type="submit">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p id="noResult" class="text-center text-gray-500 mt-4 hidden">❌ Data tidak ditemukan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <x-modal name="add-area-modal" focusable>
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
    <script>
        function filterTable() {
            let searchText = document.getElementById("searchInput").value.toLowerCase();
            let searchDate = document.getElementById("searchDate").value; // Format input: YYYY-MM-DD
            let tableBody = document.getElementById("tableBody");
            let rows = tableBody.getElementsByTagName("tr");
            let found = false;

            for (let i = 0; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");

                if (cells.length < 9) continue; // Pastikan ada minimal 8 kolom

                let column2 = cells[2].textContent.trim().toLowerCase(); // Kolom ke-2
                let column3 = cells[3].textContent.trim().toLowerCase(); // Kolom ke-3
                let combinedText = column2 + " " + column3;
                let dateColumn = cells[9].textContent.trim(); // Ambil data dari kolom ke-8
                let formattedRowDate = dateColumn.split(" ")[0]; // Ambil hanya "YYYY-MM-DD"

                let matchText = !searchText || combinedText.includes(searchText);
                let matchDate = !searchDate || formattedRowDate === searchDate;

                if (matchText && matchDate) {
                    rows[i].style.display = "";
                    found = true;
                } else {
                    rows[i].style.display = "none";
                }
            }

            document.getElementById("noResult").style.display = found ? "none" : "block";
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