<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#48a39e;">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #48a39e;">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-center text-white">Selamat Datang !</h2>
                    <p class="text-xl text-center text-white">Di Aplikasi Simulasi Pembiayaan Cicil Emas</p>
                    <p class="text-l text-center text-white">Bank Syari'ah Indonesia KC Bandung Asia Afrika</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-green-600 text-center font-bold">Berikut grafik harga dalam tahun ini:</p>

                    <!-- Grafik -->
                    <div class="overflow-x-auto w-full mt-2">
                        <div class="min-w-[600px] max-w-full">
                            <canvas id="hargaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('hargaChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($bulan), // Januari - Desember
                    datasets: [{
                            label: 'Buy Price',
                            color: 'green',
                            data: @json($buyPrices),
                            borderColor: 'blue',
                            borderWidth: 2,
                            fill: false,
                            spanGaps: true
                        },
                        {
                            label: 'Sell Price',
                            data: @json($sellPrices),
                            borderColor: 'red',
                            borderWidth: 2,
                            fill: false,
                            spanGaps: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // Menjaga proporsi grafik
                    aspectRatio: 2, // Memastikan grafik tetap terlihat proporsional di berbagai ukuran layar
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan',
                                color: 'green'
                            },
                            ticks: {
                                color: 'green' // Warna hijau untuk teks bulan
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Harga (Rp)',
                                color: 'green'
                            },
                            beginAtZero: true,
                            min: 0,
                            suggestedMax: Math.max(...@json($buyPrices), ...@json($sellPrices)) + 1000000, // Tambah 1jt dari nilai tertinggi
                            ticks: {
                                color: 'green',
                                stepSize: 1000000,
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    elements: {
                        line: {
                            tension: 0.2 // Menghaluskan garis
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>