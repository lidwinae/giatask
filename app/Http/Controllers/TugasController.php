<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Lidwina Eleonora Dora - 235150707111019

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function list()
    {
        // Query untuk list tugas
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        ORDER BY t.status DESC, t.tanggal_tenggat ASC;
        ";
    
        $tugass = DB::select($sqlTugas, [
            Auth::id()
        ]);
    
        // Query untuk kategori tugas milik user yang sedang login
        $kategoriTugas = DB::table('kategori_tugas')
        ->where('user_id', Auth::id())
        ->get();

        return view('list', compact('tugass', 'kategoriTugas'));
    }

    public function terlewat()
    {
        // Query untuk tugas terlewat
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        AND t.tanggal_tenggat < CURDATE()
        AND t.status = 'belum selesai'
        ORDER BY t.tanggal_tenggat ASC;
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

    public function berlangsung()
    {
        // Query untuk tugas berlangsung, besok, dan seterusnya
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        AND t.tanggal_tenggat >= CURDATE()
        AND t.status = 'belum selesai'
        ORDER BY t.tanggal_tenggat ASC;
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

    public function selesai()
    {
        // Query untuk tugas yang sudah selesai
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori, rt.selesai_pada
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        LEFT JOIN riwayat_tugas rt ON rt.id_tugas = t.id_tugas
        WHERE t.user_id = ?
        AND t.status = 'selesai'
        ORDER BY t.tanggal_tenggat ASC;
        ";
    
        $tugass = DB::select($sqlTugas, [
            Auth::id()
        ]);
    
        // Query untuk kategori tugas milik user yang sedang login
        $kategoriTugas = DB::table('kategori_tugas')
        ->where('user_id', Auth::id())
        ->get();

        return view('lihat.selesai', compact('tugass', 'kategoriTugas'));
    }

    public function tugas()
    {
        $sqlKategoriTugas = "
        SELECT *
        FROM kategori_tugas
        WHERE user_id = ?;
        ";
    
        $kategoriTugas = DB::select($sqlKategoriTugas, [
            Auth::id()
        ]);

        // Kirim data ke view
        return view('create.tugas', compact('kategoriTugas'));
    }

    public function kategori()
    {
        $sqlKategoriTugas = "
        SELECT *
        FROM kategori_tugas
        WHERE user_id = ?;
        ";
    
        $kategoriTugas = DB::select($sqlKategoriTugas, [
            Auth::id()
        ]);

        // Kirim data ke view
        return view('create.kategori', compact('kategoriTugas'));
    }

    public function search(Request $request)
    {
        // Mendapatkan query pencarian dari request
        $search = $request->search;
    
        // Menyimpan riwayat pencarian ke database
        if ($search) {
            $userId = Auth::id(); // Mendapatkan ID user yang sedang login
    
            DB::table('riwayat_pencarian')->insert([
                'id_user' => $userId,
                'text' => $search,
                'waktu_pencarian' => DB::raw('NOW()') // Menggunakan SQL raw function untuk mendapatkan waktu sekarang
            ]);
        }
    
        // Menyusun SQL Query untuk pencarian
        $sql = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        AND (
            t.nomor LIKE ? 
            OR t.judul LIKE ? 
            OR t.deskripsi LIKE ? 
            OR t.prioritas LIKE ? 
            OR t.status LIKE ? 
            OR DATE_FORMAT(t.tanggal_tenggat, '%Y-%m-%d') LIKE ? 
            OR kt.nama_kategori LIKE ?
        )
        ";
    
        // Menjalankan query SQL menggunakan DB::select()
        $tugass = DB::select($sql, [
            Auth::id(), // user_id
            "%$search%", // search term for string columns
            "%$search%", // search term for string columns
            "%$search%", // search term for string columns
            "%$search%", // search term for string columns
            "%$search%", // search term for string columns
            "%$search%", // search term for date (formatted as string)
            "%$search%"  // search term for kategori
        ]);
    
        // Query untuk kategori tugas milik user yang sedang login
        $kategoriTugas = DB::table('kategori_tugas')
            ->where('user_id', Auth::id())
            ->get();
    
        // Kembalikan hasil ke tampilan
        return view('list', compact('tugass', 'search', 'kategoriTugas'));
    }

    // INSERT INTO alias buat tugas baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nomor' => 'required|integer',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'prioritas' => 'required|string',
            'status' => 'required|string',
            'tanggal_tenggat' => 'required|date',
            'kategori_tugas' => 'nullable|string',
        ]);
    
        // Insert tugas baru ke dalam tabel tugas
        $inserted = DB::insert(
            'INSERT INTO tugas (nomor, judul, deskripsi, prioritas, status, tanggal_tenggat, kategori_tugas_id, user_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
            [
                $validated['nomor'],
                $validated['judul'],
                $validated['deskripsi'],
                $validated['prioritas'],
                $validated['status'],
                $validated['tanggal_tenggat'],
                $validated['kategori_tugas'], // kategori_tugas
                Auth::id() // user yang sedang login
            ]
        );
    
        // Redirect ke halaman tugas dengan pesan sukses
        if ($inserted) {
            return redirect()->route('tugas', ['#kategori'])->with('success', 'Tugas berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan tugas');
        }
    }

    public function kstore(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:50',
        ]);
    
        // Insert tugas baru ke dalam tabel tugas
        $inserted = DB::insert(
            'INSERT INTO kategori_tugas (nama_kategori, user_id) VALUES (?, ?)',
            [
                $validated['nama_kategori'],
                Auth::id() // user yang sedang login
            ]
        );
    
        // Redirect ke halaman tugas dengan pesan sukses
        if ($inserted) {
            return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kategori');
        }
    }
       
    // tombol delete
   public function destroy($id_tugas)
    {
        $sql = "DELETE FROM tugas WHERE id_tugas = ?";
        $deleted = DB::delete($sql, [$id_tugas]);
        
        if ($deleted) {
        return redirect()->route('list')->with('success', 'Tugas berhasil dihapus.');
        }
        
        return abort(404, 'Tugas tidak ditemukan');
    }

    // save changes
    public function update(Request $request, $id_tugas)
    {
        // Validasi data (jika perlu)
        $validated = $request->validate([
            'nomor' => 'required|integer',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'prioritas' => 'required|string',
            'status' => 'required|string',
            'tanggal_tenggat' => 'required|date',
            'kategori_tugas' => 'nullable|string',
        ]);

        // Update tugas menggunakan raw SQL
        DB::statement(
            'UPDATE tugas SET nomor = ?, judul = ?, deskripsi = ?, prioritas = ?, status = ?, tanggal_tenggat = ?, kategori_tugas_id = ? WHERE id_tugas = ?',
            [
                $validated['nomor'],
                $validated['judul'],
                $validated['deskripsi'],
                $validated['prioritas'],
                $validated['status'],
                $validated['tanggal_tenggat'],
                $validated['kategori_tugas'],
                $id_tugas
            ]
        );

        // Redirect atau return response setelah update
        return redirect()->route('list')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function markAsCompleted($id)
    {
        // Menandai tugas sebagai selesai
        $tugas = DB::table('tugas')->where('id_tugas', $id)->first();

        if ($tugas) {
            // Memasukkan tugas ke dalam tabel riwayat_tugas
            DB::table('riwayat_tugas')->insert([
                'id_tugas' => $tugas->id_tugas,
                'selesai_pada' => now(), // Waktu selesai
            ]);

            // Mengupdate status tugas menjadi selesai
            DB::table('tugas')
                ->where('id_tugas', $id)
                ->update(['status' => 'selesai']);

            return redirect()->route('list')->with('success', 'Tugas ditandai selesai.');
        }

        return redirect()->route('list')->with('error', 'Tugas tidak ditemukan.');
    }

    public function unmarkAsCompleted($id)
    {
        // Menandai tugas sebagai belum selesai
        $tugas = DB::table('tugas')->where('id_tugas', $id)->first();

        if ($tugas) {
            // Menghapus riwayat tugas yang telah selesai
            DB::table('riwayat_tugas')->where('id_tugas', $id)->delete();

            // Mengupdate status tugas menjadi belum selesai
            DB::table('tugas')
                ->where('id_tugas', $id)
                ->update(['status' => 'belum selesai']);

            return redirect()->route('list')->with('success', 'Tugas belum selesai.');
        }

        return redirect()->route('list')->with('error', 'Tugas tidak ditemukan.');
    }
}