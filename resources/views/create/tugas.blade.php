<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="margin-left: 30px;">
            {{ __('Buat Tugas Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Form untuk membuat tugas baru -->
                    <form method="POST" action="{{ route('tugas.store') }}" id="createForm" class="mt-6 space-y-6">
                        @csrf
                        <!-- Nomor -->
                        <div class="flex items-center space-x-4">
                            <label for="nomor" class="block font-medium text-sm text-gray-700" style="width: 30%; text-align: left;">Nomor</label>
                            <input id="nomor" name="nomor" type="number" min="0" class="mt-1 block w-full rounded-sm" required />
                            @error('nomor')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Judul -->
                        <div class="flex items-center space-x-4">
                            <label for="judul" class="block font-medium text-sm text-gray-700" style="width: 30%; text-align: left;">Judul</label>
                            <input id="judul" name="judul" type="text" class="mt-1 block w-full rounded-sm" required />
                            @error('judul')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="flex items-center space-x-4">
                            <label for="deskripsi" class="block font-medium text-sm text-gray-700" style="width: 30%; text-align: left;">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full rounded-sm" required></textarea>
                            @error('deskripsi')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Prioritas -->
                        <div class="flex items-center space-x-4">
                            <label for="prioritas" class="font-medium text-sm text-gray-700" style="width: 30%; text-align: left;">Prioritas</label>
                            <select id="prioritas" name="prioritas" class="mt-1 block w-full rounded-sm">
                                @foreach (\App\Models\Tugas::validPrioritas() as $prioritas)
                                    <option value="{{ $prioritas }}" {{ old('prioritas') == $prioritas ? 'selected' : '' }}>{{ ucfirst($prioritas) }}</option>
                                @endforeach
                            </select>
                            @error('prioritas')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="flex items-center space-x-4">
                            <label for="status" class="font-medium text-sm text-gray-700" style="width: 30%; text-align: left;">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full rounded-sm">
                                @foreach (\App\Models\Tugas::validStatus() as $status)
                                    <option value="{{ $status }}" {{ old('status', 'belum selesai') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tanggal Tenggat -->
                        <div class="flex items-center space-x-4">
                            <label for="tanggal_tenggat" class="font-medium text-sm text-gray-700" style="width: 30%; text-align: left;">Tanggal Tenggat</label>
                            <input id="tanggal_tenggat" name="tanggal_tenggat" type="date" class="mt-1 block w-full rounded-sm" required />
                            @error('tanggal_tenggat')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Kategori Tugas -->
                        <div id="kategori" class="flex items-center space-x-4">
                            <label for="kategori_tugas" class="font-medium text-sm text-gray-700" style="width: 30%; text-align: left;">Kategori</label>
                            <select id="kategori_tugas" name="kategori_tugas" class="mt-1 block w-full rounded-sm">
                                <option value=""> </option>
                                @foreach ($kategoriTugas as $kategori_tugas)
                                    <option value="{{ $kategori_tugas->id }}" {{ old('kategori_tugas') == $kategori_tugas->id ? 'selected' : '' }}>{{ $kategori_tugas->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_tugas')
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
