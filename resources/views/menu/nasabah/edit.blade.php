<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Edit Data Nasabah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-6">
                        <h1 class="text-3xl font-bold mb-6">Edit Data Nasabah</h1>
                        <form action="{{ route('nasabah.update', $nasabah->id) }}" method="POST" class="p-6">
                            @csrf
                            @method('PUT')
                            <h2 class="text-lg font-bold text-black">
                                Edit Data Nasabah
                            </h2>

                            <div class="mt-4">
                                <label for="nik" class="block text-sm font-medium text-black">User Nik</label>
                                <select name="nik" id="nik" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
                                    <option value="">-- Pilih User --</option>
                                    @foreach($user as $u)
                                    <option value="{{ $u->nik }}" data-name="{{ $u->first_name }} {{ $u->last_name }}" {{ (old('nik', $nasabah->nik) == $u->nik) ? 'selected' : '' }}>
                                        {{ $u->first_name }} {{ $u->last_name }} ( {{ $u->nik }} )
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-4">
                                <label for="name" class="block text-sm font-medium text-black">Nama</label>
                                <input type="text" name="name" id="name"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black" required value="{{ old('name', $nasabah->name) }}">
                            </div>

                            <div class="mt-4">
                                <label for="cif" class="block text-sm font-medium text-black">CIF</label>
                                <input type="text" name="cif" id="cif"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('cif', $nasabah->cif) }}" required>
                            </div>

                            <div class="mt-4">
                                <label for="portofolio" class="block text-sm font-medium text-black">Portofolio</label>
                                <input type="text" name="portofolio" id="portofolio"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('portofolio', $nasabah->portofolio) }}" required placeholder="Rp.">
                            </div>

                            <div class="mt-4">
                                <label for="penempatan" class="block text-sm font-medium text-black">Nominal Penempatan</label>
                                <input type="text" name="penempatan" id="penempatan"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('penempatan', $nasabah->penempatan) }}" required placeholder="Rp.">
                            </div>

                            <div class="mt-4">
                                <label for="dana" class="block text-sm font-medium text-black">Asal Dana</label>
                                <input type="text" name="dana" id="dana"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('dana', $nasabah->dana) }}" required readonly>
                            </div>

                            <div class="mt-4">
                                <label for="waktu" class="block text-sm font-medium text-black">Jangka Waktu</label>
                                <select name="waktu" id="waktu" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
                                    <option value="1 bulan" {{ old('waktu', $nasabah->waktu) == '1 bulan' ? 'selected' : '' }}>1 Bulan</option>
                                    <option value="3 bulan" {{ old('waktu', $nasabah->waktu) == '3 bulan' ? 'selected' : '' }}>3 Bulan</option>
                                    <option value="6 bulan" {{ old('waktu', $nasabah->waktu) == '6 bulan' ? 'selected' : '' }}>6 Bulan</option>
                                    <option value="12 bulan" {{ old('waktu', $nasabah->waktu) == '12 bulan' ? 'selected' : '' }}>12 Bulan</option>
                                    <option value="24 bulan" {{ old('waktu', $nasabah->waktu) == '24 bulan' ? 'selected' : '' }}>24 Bulan</option>
                                    <option value="36 bulan" {{ old('waktu', $nasabah->waktu) == '36 bulan' ? 'selected' : '' }}>36 Bulan</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <label for="tanggal" class="block text-sm font-medium text-black">Tanggal Penempatan</label>
                                <input type="date" name="tanggal" id="tanggal"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('tanggal', $nasabah->tanggal) }}" required>
                            </div>

                            <div class="mt-4">
                                <label for="ajuan_nisbah" class="block text-sm font-medium text-black">
                                    Nisbah Diajukan ( Jika ada koma "," gunakan titik "." contoh 1.1% )
                                </label>
                                <div class="relative mt-1">
                                    <input type="text" name="ajuan_nisbah" id="ajuan_nisbah"
                                        class="w-full pr-10 px-3 py-2 border rounded-md text-black"
                                        value="{{ old('ajuan_nisbah', $nasabah->ajuan_nisbah) }}" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="nisbah_rate" class="block text-sm font-medium text-black">
                                    Nisbah Eq.Rate ( Jika ada koma "," gunakan titik "." contoh 1.1% )
                                </label>
                                <div class="relative mt-1">
                                    <input type="text" name="nisbah_rate" id="nisbah_rate"
                                        class="w-full pr-10 px-3 py-2 border rounded-md text-black"
                                        value="{{ old('nisbah_rate', $nasabah->nisbah_rate) }}" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="status" class="block text-sm font-medium text-black">
                                    Nisbah Disetujui ( Jika ada koma "," gunakan titik "." contoh 1.1% )
                                </label>
                                <div class="relative mt-1">
                                    <input type="text" name="status" id="status"
                                        class="w-full pr-10 px-3 py-2 border rounded-md text-black"
                                        value="{{ old('status', $nasabah->status) }}" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-primary-button class="ml-3">
                                    Simpan Perubahan
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        // Set input "name" sesuai data option yang sudah dipilih saat load halaman
        window.addEventListener('DOMContentLoaded', (event) => {
            var nikSelect = document.getElementById('nik');
            var selectedOption = nikSelect.options[nikSelect.selectedIndex];
            if (selectedOption) {
                var fullName = selectedOption.getAttribute('data-name') || '';
                document.getElementById('name').value = fullName;
            }
        });

        // Update input "name" saat pilihan berubah
        document.getElementById('nik').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var fullName = selectedOption.getAttribute('data-name') || '';
            document.getElementById('name').value = fullName;
        });
    </script>
</x-app-layout>