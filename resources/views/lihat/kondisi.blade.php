<!-- Lidwina Eleonora Dora / 235150707111019 -->

@extends('layouts.template')

@section('content')

<div class="py-10">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">Nomor</th>
                        <th style="border: 1px solid #ddd; padding: 8px; width: 15%;">Judul</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Deskripsi</th>
                        <th style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">Prioritas</th>
                        <th style="border: 1px solid #ddd; padding: 8px; width: 12%; text-align: center;">Status</th>
                        <th style="border: 1px solid #ddd; padding: 8px; width: 13%; text-align: center;">Nama Kategori</th>
                        <th style="border: 1px solid #ddd; padding: 8px; width: 14%; text-align: center;">Tanggal Tenggat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugass as $tugas)
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">{{ $tugas->nomor }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; width: 15%;">{{ $tugas->judul }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $tugas->deskripsi }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; width: 5%; text-align: center;">{{ $tugas->prioritas }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; width: 12%; text-align: center;">{{ $tugas->status }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; width: 13%; text-align: center;">{{ $tugas->nama_kategori }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; width: 14%; text-align: center;">{{ $tugas->tanggal_tenggat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection