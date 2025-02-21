<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Data Akad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-6">
                        <h1 class="text-3xl font-bold mb-6">Data Akad</h1>

                        <div class="flex justify-between items-center">
                            <div class="flex flex-col md:flex-row gap-4 mb-4">
                                <!-- Input Text -->
                                <input type="text" id="searchInput" onkeyup="filterTable()"
                                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    placeholder="Cari Data...">
                            </div>
                        </div>
                        <div class="overflow-x-auto shadow-md sm:rounded-lg mt-4">
                            <table class="min-w-full table-auto" id="myTable">
                                <thead>
                                    <tr style="background-color: #0e90f5;">
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">#</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">CIF</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Nama</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Portofolio</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Ajuan Nisbah</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Nisbah Eq.Rate</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Status</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Toolls</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($data as $e)
                                    <tr class="bg-white border-b hover:bg-gray-100">
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700">{{ $e->cif }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->name }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->penempatan }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->ajuan_nisbah }}%</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->nisbah_rate }}%</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">Belum Disetujui</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap"><a href="" class="px-2 py-1 bg-red-500 hover:bg-red-600 rounded-md text-white">PDF</a></td>
                                    </tr>
                                    <x-modal name="add-area-modal{{$e->id}}" focusable>
                                        <div class="ml-4 mr-4 mb-2">
                                            <form action="{{route('perhitungan.store')}}" method="POST" class="p-6">
                                                @csrf
                                                <h2 class="text-lg font-bold text-black">
                                                    Input Nisbah
                                                </h2>

                                                <div class="mt-4">
                                                    <input type="hidden" name="id" value="{{$e->id}}">
                                                    <label for="nisbah_rate" class="block text-sm font-medium text-black">
                                                        Nisbah Eq.Rate ( Jika ada koma "," gunakan titik "." contoh 1.1% )
                                                    </label>
                                                    <div class="relative mt-1">
                                                        <input type="text" name="nisbah_rate" id="nisbah_rate"
                                                            class="w-full pr-10 px-3 py-2 border rounded-md text-black" required>
                                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                            <span class="text-gray-500">%</span>
                                                        </div>
                                                    </div>
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
                                        </div>
                                    </x-modal>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p id="noResult" class="text-center text-gray-500 mt-4 hidden">❌ Data tidak ditemukan</p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function filterTable() {
                // Ambil nilai pencarian dan ubah ke huruf kecil
                let searchText = document.getElementById("searchInput").value.toLowerCase();
                let tableBody = document.getElementById("tableBody");
                let rows = tableBody.getElementsByTagName("tr");
                let found = false;

                // Loop melalui setiap baris tabel
                for (let i = 0; i < rows.length; i++) {
                    let cells = rows[i].getElementsByTagName("td");
                    let rowText = "";
                    // Gabungkan teks dari semua kolom dalam baris
                    for (let j = 0; j < cells.length; j++) {
                        rowText += cells[j].textContent.toLowerCase() + " ";
                    }

                    // Jika nilai pencarian ditemukan dalam teks baris, tampilkan baris
                    if (!searchText || rowText.indexOf(searchText) > -1) {
                        rows[i].style.display = "";
                        found = true;
                    } else {
                        rows[i].style.display = "none";
                    }
                }

                // Tampilkan pesan jika tidak ada hasil yang ditemukan
                document.getElementById("noResult").style.display = found ? "none" : "block";
            }
        </script>
</x-app-layout>