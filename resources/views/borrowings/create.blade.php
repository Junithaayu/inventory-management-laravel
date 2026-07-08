<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Peminjaman
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('borrowings.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Nama Peminjam
                        </label>

                        <input
                            type="text"
                            name="nama_peminjam"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Tanggal Pinjam
                        </label>

                        <input
                            type="date"
                            name="tanggal_pinjam"
                            value="{{ date('Y-m-d') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Barang
                        </label>

                        <select
                            name="product_id"
                            class="w-full border rounded px-3 py-2">

                            <option value="">-- Pilih Barang --</option>

                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->nama_barang }}
                                    (Stok: {{ $product->stok }})
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">
                            Jumlah
                        </label>

                        <input
                            type="number"
                            name="jumlah"
                            min="1"
                            value="1"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="flex gap-2">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                            Simpan
                        </button>

                        <a href="{{ route('borrowings.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>