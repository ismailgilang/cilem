<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Data User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-6">
                        <h1 class="text-3xl font-bold mb-6">Data User</h1>

                        <div class="flex justify-between items-center">
                            <div class="flex flex-col md:flex-row gap-4 mb-4">
                                <!-- Input Text -->
                                <input type="text" id="searchInput" onkeyup="filterTable()"
                                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    placeholder="Cari Data...">
                            </div>
                            <div class="flex flex-col md:flex-row gap-4 mb-4">
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
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Nama Depan</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Nama Belakang</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Username</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">NIK</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Email</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Role</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-white whitespace-nowrap text-center">Tolls</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($data as $e)
                                    <tr class="bg-white border-b hover:bg-gray-100">
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700">{{$loop->iteration}}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700">{{ $e->first_name }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->last_name }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->username }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->nik }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->email }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700 whitespace-nowrap">{{ $e->role }}</td>
                                        <td class="px-4 py-2 text-sm font-medium text-center text-gray-700">
                                            <div class="flex gap-2">
                                                <a href="{{ route('user.edit', $e->id) }}" class="px-4 py-2 bg-yellow-500 text-black hover:bg-yellow-600 rounded-md">Edit</a>
                                                <form action="{{route('user.destroy', $e->id) }}" method="post">
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
    <x-modal name="add-area2-modal" focusable>
        <form action="{{route('user.store')}}" method="POST" class="p-6">
            @csrf
            <h2 class="text-lg font-bold text-black">
                Input Data User
            </h2>

            <div class="mt-4">
                <label for="first_name" class="block text-sm font-medium text-black">Nama Depan</label>
                <input type="text" name="first_name" id="first_name"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>

            <div class="mt-4">
                <label for="last_name" class="block text-sm font-medium text-black">Nama Belakang</label>
                <input type="text" name="last_name" id="last_name"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>

            <div class="mt-4">
                <label for="nik" class="block text-sm font-medium text-black">NIK</label>
                <input type="text" name="nik" id="nik"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-black">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="username" class="block text-sm font-medium text-black">Username</label>
                <input type="text" name="username" id="username"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-black">Password</label>
                <input type="text" name="password" id="password"
                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="role" class="block text-sm font-medium text-black">Role</label>
                <select name="role" id="role" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
                    <option value="admin">Admin</option>
                    <option value="nasabah">Nasabah</option>
                </select>
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
            let tableBody = document.getElementById("tableBody");
            let rows = tableBody.getElementsByTagName("tr");
            let found = false;

            // Looping setiap baris tabel
            for (let i = 0; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");

                // Gabungkan teks dari semua kolom di baris tersebut
                let rowText = "";
                for (let j = 0; j < cells.length; j++) {
                    rowText += cells[j].textContent.toLowerCase() + " ";
                }

                // Jika pencarian kosong atau rowText mengandung searchText
                if (!searchText || rowText.indexOf(searchText) > -1) {
                    rows[i].style.display = "";
                    found = true;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Tampilkan pesan "tidak ditemukan" jika tidak ada baris yang cocok
            document.getElementById("noResult").style.display = found ? "none" : "block";
        }
    </script>
</x-app-layout>