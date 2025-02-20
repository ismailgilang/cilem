<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Data Nasabah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-6">
                        <h1 class="text-3xl font-bold mb-6">Data Nasabah</h1>

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
                                <button type="button"
                                    class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-500 text-white hover:bg-green-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    x-data x-on:click="$dispatch('open-modal', 'add-area-modal')">
                                    Cetak
                                </button>
                                <button type="button"
                                    class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-500 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    x-data x-on:click="$dispatch('open-modal', 'add-area2-modal')">
                                    Tambah Data
                                </button>
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
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Nominal Penempatan</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Asal Dana</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Jangka Waktu</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Tanggal Penempatan</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Nisbah Diajukan</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Nisbah Eq.rate</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Nisbah Disetujui</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Tolls</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($data as $e)
                                    <tr class="bg-white border-b hover:bg-gray-100">
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700">{{$loop->iteration}}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700">{{ $e->cif }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->name }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->portofolio }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->penempatan }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->dana }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->waktu }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->tanggal }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->ajuan_nisbah }}%</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">
                                            @if(!isset($e->nisbah_rate))
                                            <p class="px-2 bg-red-500 text-white rounded-md">Belum Dibuat</p>
                                            @else
                                            {{ $e->nisbah_rate }}%
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">
                                            @if(!isset($e->status))
                                            <p class="px-2 bg-red-500 text-white rounded-md">Belum Dibuat</p>
                                            @else
                                            {{ $e->status }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700">
                                            <div class="flex gap-2">
                                                <a href="#" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 rounded-md">Cetak</a>
                                                <a href="{{ route('nasabah.edit', $e->id) }}" class="px-4 py-2 bg-yellow-500 text-black hover:bg-yellow-600 rounded-md">Edit</a>
                                                <form action="{{route('nasabah.destroy', $e->id) }}" method="post">
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
        <form action="{{route('cetak.nasabah')}}" method="POST" class="p-6">
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
    <x-modal name="add-area2-modal" focusable>
        <form action="{{route('nasabah.store')}}" method="POST" class="p-6">
            @csrf
            <h2 class="text-lg font-bold text-black">
                Input Data Nasabah
            </h2>

            <div class="mt-4">
                <label for="cif" class="block text-sm font-medium text-black">CIF</label>
                <input type="text" name="cif" id="cif"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>

            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-black">Nama</label>
                <input type="text" name="name" id="name"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>

            <div class="mt-4">
                <label for="portofolio" class="block text-sm font-medium text-black">Portofolio</label>
                <input type="text" name="portofolio" id="portofolio"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required placeholder="Rp.">
            </div>
            <div class="mt-4">
                <label for="penempatan" class="block text-sm font-medium text-black">Nominal Penempatan</label>
                <input type="text" name="penempatan" id="penempatan"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required placeholder="Rp.">
            </div>
            <div class="mt-4">
                <label for="dana" class="block text-sm font-medium text-black">Asal Dana</label>
                <input type="text" name="dana" id="dana"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required value="Fresh Fund" readonly>
            </div>
            <div class="mt-4">
                <label for="waktu" class="block text-sm font-medium text-black">Jangka Waktu</label>
                <select name="waktu" id="waktu" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
                    <option value="1 bulan">1 Bulan</option>
                    <option value="3 bulan">3 Bulan</option>
                    <option value="6 bulan">6 Bulan</option>
                    <option value="12 bulan">12 Bulan</option>
                    <option value="24 bulan">24 Bulan</option>
                    <option value="36 bulan">36 Bulan</option>
                </select>
            </div>

            <div class="mt-4">
                <label for="tanggal" class="block text-sm font-medium text-black">tanggal Penempatan</label>
                <input type="date" name="tanggal" id="tanggal"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="ajuan_nisbah" class="block text-sm font-medium text-black">
                    Nisbah Diajukan ( Jika ada koma "," gunakan titik "." contoh 1.1% )
                </label>
                <div class="relative mt-1">
                    <input type="text" name="ajuan_nisbah" id="ajuan_nisbah"
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
                let combinedText = column2 + " " + column3;
                let dateColumn = cells[7].textContent.trim(); // Ambil data dari kolom ke-8
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
        function formatRupiah(angka, prefix = 'Rp ') {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix + rupiah;
        }

        document.getElementById('penempatan').addEventListener('input', function(e) {
            this.value = formatRupiah(this.value);
        });
        document.getElementById('portofolio').addEventListener('input', function(e) {
            this.value = formatRupiah(this.value);
        });
    </script>
</x-app-layout>