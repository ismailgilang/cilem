<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #c5b651;">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-center text-white">Selamat Datang !</h2>
                    <p class="text-xl text-center text-white">Di Aplikasi Pengelolaan Nisbah Deposito</p>
                    <p class="text-l text-center text-white">Bank Syari'ah Indonesia KC Bandung Asia Afrika</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>