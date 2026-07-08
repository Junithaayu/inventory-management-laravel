<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">

                    <form action="{{ route('products.index') }}" method="GET" class="flex gap-2">

                        <input
                            type="text"
                            name="keyword"
                            value="{{ $keyword }}"
                            placeholder="Cari nama atau kode barang..."
                            class="border rounded px-3 py-2 w-72">

                        <button
                            type="submit"
                            class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                            Cari
                        </button>

                    </form>

                    <a
                        href="{{ route('products.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Tambah Produk
                    </a>

                </div>>

                <table class="w-full border border-gray-300">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">No</th>
                            <th class="border p-2">Gambar</th>
                            <th class="border p-2">Kode</th>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Stok</th>
                            <th class="border p-2">Lokasi</th>
                            <th class="border p-2">Kondisi</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($products as $product)

                        <tr>

                            <td class="border p-2">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-2">

                                @if($product->gambar)
                                    <img
                                        src="{{ asset('storage/'.$product->gambar) }}"
                                        class="w-20 h-20 object-cover rounded">
                                @else
                                    -
                                @endif

                            </td>

                            <td class="border p-2">
                                {{ $product->kode_barang }}
                            </td>

                            <td class="border p-2">
                                {{ $product->nama_barang }}
                            </td>

                            <td class="border p-2">
                                {{ $product->category->name }}
                            </td>

                            <td class="border p-2">
                                {{ $product->stok }}
                            </td>

                            <td class="border p-2">
                                {{ $product->lokasi_penyimpanan }}
                            </td>

                            <td class="border p-2">
                                {{ $product->kondisi_barang }}
                            </td>

                            <td class="border p-2">

                                <a href="{{ route('products.show', $product) }}"
                                    class="text-green-600 hover:underline mr-3">
                                    Lihat
                                </a>
                                
                                <a href="{{ route('products.edit', $product) }}"
                                class="text-blue-600 hover:underline mr-3">
                                    Edit
                                </a>

                                <form action="{{ route('products.destroy', $product) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-red-600 hover:underline">
                                        Hapus
                                    </button>

                                </form>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="9" class="text-center p-4">
                                Belum ada produk.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

            </table>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>