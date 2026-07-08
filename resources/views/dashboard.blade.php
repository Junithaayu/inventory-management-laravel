<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Inventaris
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-blue-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold">
                        Total Kategori
                    </h3>

                    <p class="text-4xl font-bold mt-4">
                        {{ $jumlahKategori }}
                    </p>
                </div>

                <div class="bg-green-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold">
                        Jumlah Jenis Barang
                    </h3>

                    <p class="text-4xl font-bold mt-4">
                        {{ $jumlahProduk }}
                    </p>
                </div>

                <div class="bg-yellow-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold">
                        Sedang Dipinjam
                    </h3>

                    <p class="text-4xl font-bold mt-4">
                        {{ $barangDipinjam }}
                    </p>
                </div>

                <div class="bg-purple-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold">
                        Sudah Dikembalikan
                    </h3>

                    <p class="text-4xl font-bold mt-4">
                        {{ $barangDikembalikan }}
                    </p>
                </div>

            </div>

            <div class="mt-8 bg-white shadow rounded-lg p-6">

                <h3 class="text-xl font-bold mb-4">
                    Peminjaman Terbaru
                </h3>

                <table class="w-full border border-gray-300">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Peminjam</th>
                            <th class="border px-4 py-2">Barang</th>
                            <th class="border px-4 py-2">Jumlah</th>
                            <th class="border px-4 py-2">Tanggal</th>
                            <th class="border px-4 py-2">Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($peminjamanTerbaru as $borrowing)

                            <tr>

                                <td class="border px-4 py-2">
                                    {{ $borrowing->nama_peminjam }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $borrowing->details->first()?->product?->nama_barang ?? '-' }}
                                </td>

                                <td class="border px-4 py-2 text-center">
                                    {{ $borrowing->details->first()?->jumlah ?? '-' }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $borrowing->tanggal_pinjam }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $borrowing->status }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Belum ada data peminjaman.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-8 bg-white shadow rounded-lg p-6">

                <h3 class="text-xl font-bold mb-4 text-red-600">
                    ⚠️ Stok Hampir Habis
                </h3>

                <table class="w-full border border-gray-300">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Kode</th>
                            <th class="border px-4 py-2">Nama Barang</th>
                            <th class="border px-4 py-2">Stok</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($stokMenipis as $product)

                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $product->kode_barang }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $product->nama_barang }}
                                </td>

                                <td class="border px-4 py-2 text-center text-red-600 font-bold">
                                    {{ $product->stok }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    Semua stok masih aman.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="bg-emerald-500 text-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold">
                    Total Stok Tersedia
                </h3>

                <p class="text-4xl font-bold mt-4">
                    {{ $barangTersedia }}
                </p>
            </div>

        </div>
    </div>

    <div class="mt-8 bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-bold mb-4">
            Grafik Peminjaman per Bulan
        </h3>

        <canvas id="borrowingChart" height="100"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = [
            @foreach($grafikPeminjaman as $item)
                'Bulan {{ $item->bulan }}',
            @endforeach
        ];

        const data = [
            @foreach($grafikPeminjaman as $item)
                {{ $item->total }},
            @endforeach
        ];

        new Chart(document.getElementById('borrowingChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: data
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>