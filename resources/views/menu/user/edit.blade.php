<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Edit Data User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-6">
                        <h1 class="text-3xl font-bold mb-6">Edit Data User</h1>
                        <form action="{{ route('user.update', $data->id) }}" method="POST" class="p-6">
                            @csrf
                            @method('PUT')
                            <h2 class="text-lg font-bold text-black">
                                Edit Data User
                            </h2>

                            <div class="mt-4">
                                <label for="first_name" class="block text-sm font-medium text-black">Nama Depan</label>
                                <input type="text" name="first_name" id="first_name"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('first_name', $data->first_name) }}" required>
                            </div>

                            <div class="mt-4">
                                <label for="last_name" class="block text-sm font-medium text-black">Nama Belakang</label>
                                <input type="text" name="last_name" id="last_name"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('last_name', $data->last_name) }}" required>
                            </div>

                            <div class="mt-4">
                                <label for="nik" class="block text-sm font-medium text-black">NIK</label>
                                <input type="text" name="nik" id="nik"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('nik', $data->nik) }}" required>
                            </div>

                            <div class="mt-4">
                                <label for="email" class="block text-sm font-medium text-black">Email</label>
                                <input type="email" name="email" id="email"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('email', $data->email) }}" required>
                            </div>

                            <div class="mt-4">
                                <label for="username" class="block text-sm font-medium text-black">Username</label>
                                <input type="text" name="username" id="username"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    value="{{ old('username', $data->username) }}" required>
                            </div>

                            <div class="mt-4">
                                <label for="password" class="block text-sm font-medium text-black">Password</label>
                                <input type="text" name="password" id="password"
                                    class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                                    placeholder="Kosongkan jika tidak diubah">
                            </div>

                            <div class="mt-4">
                                <label for="role" class="block text-sm font-medium text-black">role</label>
                                <select name="role" id="role" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
                                    <option value="admin" {{ old('role', $data->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="nasabah" {{ old('role', $data->role) == 'nasabah' ? 'selected' : '' }}>Nasabah</option>
                                </select>
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
</x-app-layout>