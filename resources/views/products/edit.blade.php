<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">Kategori</label>

                        <select name="category_id"
                                class="w-full border rounded px-3 py-2">

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Kode -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">Kode Barang</label>

                        <input
                            type="text"
                            name="kode_barang"
                            value="{{ $product->kode_barang }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Nama -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">Nama Barang</label>

                        <input
                            type="text"
                            name="nama_barang"
                            value="{{ $product->nama_barang }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Stok -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">Stok</label>

                        <input
                            type="number"
                            name="stok"
                            value="{{ $product->stok }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">Lokasi Penyimpanan</label>

                        <input
                            type="text"
                            name="lokasi_penyimpanan"
                            value="{{ $product->lokasi_penyimpanan }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Kondisi -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">Kondisi Barang</label>

                        <input
                            type="text"
                            name="kondisi_barang"
                            value="{{ $product->kondisi_barang }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Gambar -->
                    <div class="mb-6">
                        <label class="block font-medium mb-2">Gambar Baru (Opsional)</label>

                        <input
                            type="file"
                            name="gambar"
                            class="w-full border rounded px-3 py-2">

                        @if($product->gambar)
                            <img
                                src="{{ asset('storage/' . $product->gambar) }}"
                                class="w-32 mt-3 rounded border">
                        @endif
                    </div>

                    <div class="flex gap-2">
                        <button
                            type="submit"
                            class="bg-yellow-500 text-white px-4 py-2 rounded">
                            Update
                        </button>

                        <a href="{{ route('products.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>