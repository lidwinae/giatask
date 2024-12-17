<!-- Lidwina Eleonora Dora / 235150707111019 -->

@extends('layouts.template')

@section('content')

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
            <form method="get" action="/search">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                    <!-- Tugas Baru -->
                    <a href="/tugas" style="background-color: #3F8CDF; margin-right: 20px;
                    color: white; border-radius: 8px; padding: 10px 20px; text-decoration: none;">
                    <span style="font-size: 14px;"><i class="fas fa-plus"></i></span>
                    <span style="font-size: 18px; margin-left: 5px;">Tugas Baru</span></a>

                    <!-- Kategori Baru -->
                    <a href="/kategori" style="background-color: white; color: #4fa3e8; border: 2px solid #4fa3e8;
                    padding: 10px 20px; border-radius: 8px; text-decoration: none;">
                    <span style="font-size: 14px;"><i class="fas fa-plus"></i></span>
                    <span style="font-size: 16px; margin-left: 5px;"><b>Kategori Baru</b></span></a>
                    </div>

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

                    <!-- Search dan CARI -->
                    <div class="flex items-center">
                    <input 
                        class="form-control" 
                        name="search" 
                        placeholder="Search..." 
                        value="{{ isset($search) ? $search : '' }}"
                        style="width: 300px; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
                    <button 
                        type="submit" 
                        style="background-color: #3F8CDF; margin-left: 10px; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">
                        CARI
                    </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">Nomor</th>
                            <th style="border: 1px solid #ddd; padding: 8px; width: 13%;">Judul</th>
                            <th style="border: 1px solid #ddd; padding: 8px; width: 18%;">Deskripsi</th>
                            <th style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">Prioritas</th>
                            <th style="border: 1px solid #ddd; padding: 8px; width: 12%; text-align: center;">Status</th>
                            <th style="border: 1px solid #ddd; padding: 8px; width: 13%; text-align: center;">Nama Kategori</th>
                            <th style="border: 1px solid #ddd; padding: 8px; width: 14%; text-align: center;">Tanggal Tenggat</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($tugass as $tugas)
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">{{ $tugas->nomor }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; width: 13%;">{{ $tugas->judul }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; width: 18%;">{{ $tugas->deskripsi }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">{{ $tugas->prioritas }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; width: 12%; text-align: center;">{{ $tugas->status }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; width: 13%; text-align: center;">{{ $tugas->nama_kategori }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; width: 14%; text-align: center;">{{ $tugas->tanggal_tenggat }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="color: white; background-color: blue; padding: 4px 12px; text-decoration: none; border-radius: 4px; margin-right: 10px;
                                margin-top: 10px; margin-bottom: 10px;" 
                                data-id="{{ $tugas->id_tugas }}" 
                                data-nomor="{{ $tugas->nomor }}"
                                data-judul="{{ $tugas->judul }}" 
                                data-deskripsi="{{ $tugas->deskripsi }}" 
                                data-prioritas="{{ $tugas->prioritas }}" 
                                data-status="{{ $tugas->status }}" 
                                data-tanggal_tenggat="{{ $tugas->tanggal_tenggat }}" 
                                data-kategori_tugas="{{ $tugas->kategori_tugas_id }}">Edit</button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Edit Tugas</b></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="padding-top: 1px; padding-bottom: 10px;">
                                                <form method="post" action="{{ route('tugas.update', $tugas->id_tugas) }}" id="editForm" class="mt-6 space-y-6">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Nomor -->
                                                    <div class="flex items-center space-x-4">
                                                        <label for="nomor" class="block font-medium text-sm text-gray-700"
                                                            style="width: 30%; text-align: left;">Nomor</label>
                                                        <input id="nomor" name="nomor" type="number" min="0" class="mt-1 block w-full rounded-sm" required />
                                                    </div>                                                    

                                                    <!-- Judul -->
                                                    <div class="flex items-center space-x-4">
                                                        <label for="judul" class="block font-medium text-sm text-gray-700"
                                                            style="width: 30%; text-align: left;">Judul</label>
                                                        <input id="judul" name="judul" type="text" class="mt-1 block w-full rounded-sm" required />
                                                    </div>

                                                    <!-- Deskripsi -->
                                                    <div class="flex items-center space-x-4">
                                                        <label for="deskripsi" class="block font-medium text-sm text-gray-700"
                                                            style="width: 30%; text-align: left;">Deskripsi</label>
                                                        <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full rounded-sm" required></textarea>
                                                    </div>

                                                    <!-- Prioritas -->
                                                    <div class="flex items-center space-x-4">
                                                        <label for="prioritas" class="font-medium text-sm text-gray-700"
                                                            style="width: 30%; text-align: left;">Prioritas</label>
                                                        <select id="prioritas" name="prioritas" class="mt-1 block w-full rounded-sm">
                                                            @foreach (\App\Models\Tugas::validPrioritas() as $prioritas)
                                                                <option value="{{ $prioritas }}">{{ ucfirst($prioritas) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Status -->
                                                    <div class="flex items-center space-x-4">
                                                        <label for="status" class="font-medium text-sm text-gray-700"
                                                            style="width: 30%; text-align: left;">Status</label>
                                                        <select id="status" name="status" class="mt-1 block w-full rounded-sm">
                                                            @foreach (\App\Models\Tugas::validStatus() as $status)
                                                                <option value="{{ $status }}">{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Tanggal Tenggat -->
                                                    <div class="flex items-center space-x-4">
                                                        <label for="tanggal_tenggat" class="font-medium text-sm text-gray-700"
                                                            style="width: 40%; text-align: left;">Tanggal Tenggat</label>
                                                        <input id="tanggal_tenggat" name="tanggal_tenggat" type="date"
                                                            class="mt-1 block w-full rounded-sm" required />
                                                    </div>

                                                    <!-- Kategori Tugas -->
                                                    <div class="flex items-center space-x-4">
                                                        <label for="kategori_tugas" class="font-medium text-sm text-gray-700"
                                                            style="width: 30%; text-align: left;">Kategori</label>
                                                        <select id="kategori_tugas" name="kategori_tugas" class="mt-1 block w-full rounded-sm">
                                                            <option value=""> </option>
                                                            @foreach ($kategoriTugas as $kategori_tugas)
                                                                <option value="{{ $kategori_tugas->id }}">{{ $kategori_tugas->nama_kategori }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button id="save-changes" type="submit" form="editForm" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <!-- Button Hapus -->
                                    <form method="POST" action="{{ route('tugas.destroy', $tugas->id_tugas) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color: white; background-color: red; padding: 5px 10px; text-decoration: none; border-radius: 4px; border: none;"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                    <!-- Button Tandai Selesai atau Belum Selesai -->
                                    @if ($tugas->status == 'selesai')
                                        <!-- Tombol untuk menandai tugas belum selesai -->
                                        <form method="POST" action="{{ route('tugas.belum_selesai', $tugas->id_tugas) }}" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning"
                                            style="margin-top: 10px; margin-bottom: 10px;">Tandai Belum</button>
                                        </form>
                                    @else
                                        <!-- Tombol untuk menandai tugas selesai -->
                                        <form method="POST" action="{{ route('tugas.selesai', $tugas->id_tugas) }}" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success"
                                            style="margin-top: 10px; margin-bottom: 10px;">Tandai Selesai</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br><br>

@endsection