<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kategori
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $category->name) }}"
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
                            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                            Update
                        </button>

                        <a
                            href="{{ route('categories.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>