<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Simulasi Cicil Emas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-6">
                        <h1 class="text-3xl font-bold mb-6">Cicil Emas</h1>

                        <div class="flex justify-between items-center">
                            <div class="flex flex-col md:flex-row gap-4 mb-4">
                                <!-- Input Text -->
                                <input type="text" id="searchInput" onkeyup="filterTable()"
                                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    placeholder="Cari Data...">

                                <input type="date" id="searchDate" onchange="filterTable()"
                                    class="px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="flex-col md:flex-row gap-4 mb-4">
                                <a href="{{route('cilem.create')}}" class="px-2 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">Buat Cilem</a>
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
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Name</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Nik</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Banyak Gram</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Harga</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Uang Muka</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Pembiayaan</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Adm</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Total dp + Adm</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Lama Angsuran</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Harga Angsuran</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Dibuat Pada</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Tolls</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($data as $e)
                                    <tr class="bg-white border-b hover:bg-gray-100">
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700">{{$loop->iteration}}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700">{{ $e->name }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->nik }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->banyak }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->harga_asli }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->uang_muka }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->pembiayaan }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->adm }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->tot_adm }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->angsuran }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->bayar_angsuran }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $e->created_at }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-700">
                                            <div class="flex gap-2">
                                                <a href="{{route('cilem.edit', $e->id)}}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-black rounded-md">Edit</a>
                                                <form action="{{route('cilem.destroy', $e->id) }}" method="post">
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

                    let column2 = cells[1].textContent.trim().toLowerCase(); // Kolom ke-2
                    let column3 = cells[2].textContent.trim().toLowerCase(); // Kolom ke-3
                    let column4 = cells[3].textContent.trim().toLowerCase(); // Kolom ke-2
                    let combinedText = column2 + " " + column3 + " " + column4;
                    let dateColumn = cells[11].textContent.trim(); // Ambil data dari kolom ke-8
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
</x-app-layout>