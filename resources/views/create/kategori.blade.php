<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="margin-left: 30px;">
            {{ __('Buat Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Form untuk membuat tugas baru -->
                    <form method="POST" action="{{ route('kategori.store') }}" id="createForm" class="mt-6 space-y-6">
                        @csrf

                        <!-- Nama Kategori -->
                        <div class="flex items-center space-x-4">
                            <label for="kategori" class="block font-medium text-sm text-gray-700" style="width: 40%; text-align: center; margin-right: 20px;">Nama Kategori</label>
                            <input id="kategori" name="nama_kategori" type="text" class="mt-1 block w-full rounded-sm" required />
                            @error('kategori')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end">
                            @if (session('success'))
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 3000)"
                                    style="background-color: #D4EDDA; color: #155724;
                                    padding: 10px; border: 1px solid #C3E6CB; border-radius: 5px;
                                    margin-bottom: 5px; margin-right: 20px;"
                                >
                                    {{ session('success') }}
                                </p>
                            @endif
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md"
                            style="background-color: #3F8CDF; color: white; border: 2px solid transparent; margin-top: 20px; margin-bottom: 20px;
                                border-radius: 8px; padding: 10px 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                                <b>Simpan</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
