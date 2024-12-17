@extends('pengaturan.rapihin')

<!-- Lidwina Eleonora Dora - 235150707111019 -->
 <!-- Tabel-tabelnya saja -->

<!-- Tabel Kategori -->
@section('kategori')

<div class="flex justify-between items-center"
    style="margin-right: 25%; margin-top: 10px; margin-bottom: 25px;">
    <!-- Kategori Baru -->
    <a href="/kategori" style="background-color: white; color: #4fa3e8; border: 2px solid #4fa3e8;
                    padding: 7px 9px; border-radius: 8px; text-decoration: none;">
        <span style="font-size: 12px; margin-left: 5px;"><i class="fas fa-plus"></i></span>
        <span style="font-size: 16px; margin-left: 5px; margin-right: 2px;"><b>Kategori Baru</b></span></a>
<!-- Hapus Semua Tugas -->
<form action="{{ route('kategori.destroy.all') }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua kategori?')">Hapus Semua Kategori</button>
</form>
</div>
<table class="table table-striped w-3/4" style="text-align: right;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px; width: 50%; text-align: center;">Nama Kategori</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategoriTugas as $kategori_tugas)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px; width: 50%; text-align: center;">{{ $kategori_tugas->nama_kategori }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                style="color: white; background-color: blue; padding: 4px 12px; text-decoration: none; border-radius: 4px; margin-right: 10px;" 
                data-id="{{ $kategori_tugas->id }}" 
                data-nama_kategori="{{ $kategori_tugas->nama_kategori }}">Edit</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><b>Edit Kategori</b></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="padding-top: 1px; padding-bottom: 10px;">
                                <form method="post" action="{{ route('kategori.update', $kategori_tugas->id) }}" id="editForm" class="mt-6 space-y-6">
                                    @csrf
                                    @method('PUT')                                                  

                                    <!-- Nama Kategori -->
                                    <div class="flex items-center space-x-4">
                                        <label for="nama_kategori" class="block font-medium text-sm text-gray-700"
                                            style="width: 30%; text-align: left;">Nama Kategori</label>
                                        <input id="nama_kategori" name="nama_kategori" type="text" class="mt-1 block w-full rounded-sm" required />
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

                    <form method="POST" action="{{ route('kategori.destroy', $kategori_tugas->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: white; background-color: red; padding: 5px 10px; text-decoration: none; border-radius: 4px; border: none;"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

<!-- Tabel Email -->

@section('email')

<div style="text-align: right; margin-right: 1%; margin-top: 10px; margin-bottom: 25px;">

<!-- Hapus Semua Riwayat Emails -->
<form action="{{ route('riwayate.destroy.all') }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua riwayat email? Email yang sudah terkirim tidak akan terhapus')">Hapus Semua Riwayat Email</button>
</form>
</div>

<table class="table table-striped w-full">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">Nomor</th>
            <th style="border: 1px solid #ddd; padding: 8px; width: 20%; text-align: left;">Judul</th>
            <th style="border: 1px solid #ddd; padding: 8px; width: 20%; text-align: left;">to</th>
            <th style="border: 1px solid #ddd; padding: 8px; width: 20%; text-align: left;">Subject</th>
            <th style="border: 1px solid #ddd; padding: 8px; width: 25%; text-align: center;">Dikirim Pada</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($riwayate as $riwayat_emails)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">{{ $riwayat_emails->nomor }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; width: 20%; text-align: left;">{{ $riwayat_emails->judul }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; width: 20%; text-align: left;">{{ $riwayat_emails->to }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; width: 20%; text-align: left;">{{ $riwayat_emails->subject }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; width: 25%; text-align: center;">{{ $riwayat_emails->dikirim_pada }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                    <form method="POST" action="{{ route('riwayate.destroy', $riwayat_emails->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: white; background-color: red; padding: 5px 10px; text-decoration: none; border-radius: 4px; border: none;"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat email ini? Email yang sudah terkirim tidak akan terhapus')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

<!-- Tabel Pencarian -->

@section('pencarian')

<div style="text-align: right; margin-right: 25%; margin-top: 10px; margin-bottom: 25px;">

<!-- Hapus Semua Pencarian -->
<form action="{{ route('riwayat.destroy.all') }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua riwayat pencarian?')">Hapus Semua Riwayat Pencarian</button>
</form>
</div>

<table class="table table-striped w-3/4" style="text-align: right;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px; width: 50%; text-align: left;">Text</th>
            <th style="border: 1px solid #ddd; padding: 8px; width: 30%; text-align: center;">Waktu Pencarian</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($riwayat as $riwayat_pencarian)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px; width: 50%; text-align: left;">{{ $riwayat_pencarian->text }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; width: 30%; text-align: center;">{{ $riwayat_pencarian->waktu_pencarian }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                    <form method="POST" action="{{ route('riwayat.destroy', $riwayat_pencarian->id_pencarian) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: white; background-color: red; padding: 5px 10px; text-decoration: none; border-radius: 4px; border: none;"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat pencarian ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection