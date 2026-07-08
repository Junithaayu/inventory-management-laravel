<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Peminjaman
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">
                        Daftar Peminjaman
                    </h2>

                    <a href="{{ route('borrowings.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded">
                        + Tambah Peminjaman
                    </a>
                </div>

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Peminjam</th>
                            <th class="border px-4 py-2">Barang</th>
                            <th class="border px-4 py-2">Jumlah</th>
                            <th class="border px-4 py-2">Tanggal Pinjam</th>
                            <th class="border px-4 py-2">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($borrowings as $borrowing)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $loop->iteration }}
                                </td>

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
                                <td colspan="6" class="text-center py-4">
                                    Belum ada data peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $borrowings->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>