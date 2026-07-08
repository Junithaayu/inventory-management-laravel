<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="mb-6">
                    @if($product->gambar)
                        <img
                            src="{{ asset('storage/'.$product->gambar) }}"
                            class="w-56 rounded border">
                    @else
                        <p>Tidak ada gambar.</p>
                    @endif
                </div>

                <table class="w-full border border-gray-300">

                    <tr>
                        <th class="border p-3 text-left w-1/3">
                            Kode Barang
                        </th>
                        <td class="border p-3">
                            {{ $product->kode_barang }}
                        </td>
                    </tr>

                    <tr>
                        <th class="border p-3 text-left">
                            Nama Barang
                        </th>
                        <td class="border p-3">
                            {{ $product->nama_barang }}
                        </td>
                    </tr>

                    <tr>
                        <th class="border p-3 text-left">
                            Kategori
                        </th>
                        <td class="border p-3">
                            {{ $product->category->name }}
                        </td>
                    </tr>

                    <tr>
                        <th class="border p-3 text-left">
                            Stok
                        </th>
                        <td class="border p-3">
                            {{ $product->stok }}
                        </td>
                    </tr>

                    <tr>
                        <th class="border p-3 text-left">
                            Lokasi Penyimpanan
                        </th>
                        <td class="border p-3">
                            {{ $product->lokasi_penyimpanan }}
                        </td>
                    </tr>

                    <tr>
                        <th class="border p-3 text-left">
                            Kondisi Barang
                        </th>
                        <td class="border p-3">
                            {{ $product->kondisi_barang }}
                        </td>
                    </tr>

                </table>

                <div class="mt-6">
                    <a href="{{ route('products.index') }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>