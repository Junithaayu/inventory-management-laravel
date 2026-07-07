<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Kategori
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('categories.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded">
                        + Tambah Kategori
                    </a>
                </div>

                <table class="w-full border">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a
                                            href="{{ route('categories.edit', $category) }}"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                            </a>

                                            <form
                                                action="{{ route('categories.destroy', $category) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    Belum ada kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $categories->links() }}

            </div>
        </div>
    </div>
</x-app-layout>