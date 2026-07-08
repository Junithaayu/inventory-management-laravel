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
                        Total Produk
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

        </div>
    </div>
</x-app-layout>