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

                <form method="POST">
                    @csrf

                    <button type="submit">
                        Simpan
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>