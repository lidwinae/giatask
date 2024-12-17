<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Lidwina Eleonora Dora - 235150707111019

class FilterController extends Controller
{
    public function nomor()
    {
        // Query untuk urutkan nomor
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        AND t.status = 'belum selesai'
        ORDER BY t.nomor ASC, t.tanggal_tenggat ASC;
        ";
    
        $tugass = DB::select($sqlTugas, [
            Auth::id()
        ]);
    
        // Query untuk kategori tugas milik user yang sedang login
        $kategoriTugas = DB::table('kategori_tugas')
        ->where('user_id', Auth::id())
        ->get();

        return view('lihat.kondisi', compact('tugass', 'kategoriTugas'));
    }

    public function judul()
    {
        // Query untuk urutkan nomor
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        AND t.status = 'belum selesai'
        ORDER BY t.judul ASC, t.tanggal_tenggat ASC;
        ";
    
        $tugass = DB::select($sqlTugas, [
            Auth::id()
        ]);
    
        // Query untuk kategori tugas milik user yang sedang login
        $kategoriTugas = DB::table('kategori_tugas')
        ->where('user_id', Auth::id())
        ->get();

        return view('lihat.kondisi', compact('tugass', 'kategoriTugas'));
    }

    public function prio()
    {
        // Query untuk urutkan nomor
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        AND t.status = 'belum selesai'
        ORDER BY t.prioritas ASC, t.tanggal_tenggat ASC;
        ";
    
        $tugass = DB::select($sqlTugas, [
            Auth::id()
        ]);
    
        // Query untuk kategori tugas milik user yang sedang login
        $kategoriTugas = DB::table('kategori_tugas')
        ->where('user_id', Auth::id())
        ->get();

        return view('lihat.kondisi', compact('tugass', 'kategoriTugas'));
    }

    public function desk()
    {
        // Query untuk urutkan nomor
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        AND t.status = 'belum selesai'
        ORDER BY t.deskripsi ASC, t.tanggal_tenggat ASC;
        ";
    
        $tugass = DB::select($sqlTugas, [
            Auth::id()
        ]);
    
        // Query untuk kategori tugas milik user yang sedang login
        $kategoriTugas = DB::table('kategori_tugas')
        ->where('user_id', Auth::id())
        ->get();

        return view('lihat.kondisi', compact('tugass', 'kategoriTugas'));
    }

    public function kate()
    {
        // Query untuk urutkan nomor
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        AND t.status = 'belum selesai'
        ORDER BY kt.nama_kategori ASC, t.tanggal_tenggat ASC;
        ";
    
        $tugass = DB::select($sqlTugas, [
            Auth::id()
        ]);
    
        // Query untuk kategori tugas milik user yang sedang login
        $kategoriTugas = DB::table('kategori_tugas')
        ->where('user_id', Auth::id())
        ->get();

        return view('lihat.kondisi', compact('tugass', 'kategoriTugas'));
    }
}