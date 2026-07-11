<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow rounded-lg p-6">

                HALO

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <button type="submit">
                        Simpan
                    </button>
                </form>

                <div class="mb-4">
                    <label>Kategori</label>

                    <select name="category_id">
                        <option value="">Pilih</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>