<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kategori
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full border rounded px-3 py-2">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                            Simpan
                        </button>

                        <a
                            href="{{ route('categories.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>