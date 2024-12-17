<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Lidwina Eleonora Dora - 235150707111019

class PengaturanController extends Controller
{
    public function riwayat()
    {
        // Query untuk list riwayat pencarian
        $sqlTugas = "
        SELECT *
        FROM riwayat_pencarian
        WHERE id_user = ?;
        ";
    
        $riwayat = DB::select($sqlTugas, [
            Auth::id()
        ]);
    
        // Ambil kategori tugas
        $sqlKategoriTugas = "
        SELECT *
        FROM kategori_tugas
        WHERE user_id = ?;
        ";
    
        $kategoriTugas = DB::select($sqlKategoriTugas, [
            Auth::id()
        ]);

        // Query untuk list riwayat emails
        $sqlTugass = "
        SELECT re.*, t.nomor, t.judul
        FROM riwayat_emails re
        LEFT JOIN tugas t ON re.tugas_id = t.id_tugas
        WHERE re.user_id = ?;
        ";
    
        $riwayate = DB::select($sqlTugass, [
            Auth::id()
        ]);
    
        // Kirimkan kedua variabel ke view
        return view('pengaturan.pengaturan', compact('riwayat', 'kategoriTugas', 'riwayate'));
    }
    

    public function update(Request $request, $id)
    {
        // Validasi data (jika perlu)
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:50',
        ]);

        // Update tugas menggunakan raw SQL
        DB::statement(
            'UPDATE kategori_tugas SET nama_kategori = ? WHERE id = ?',
            [
                $validated['nama_kategori'],
                $id
            ]
        );

        // Redirect atau return response setelah update
        return redirect()->route('pengaturan')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $sql = "DELETE FROM kategori_tugas WHERE id = ?";
        $deleted = DB::delete($sql, [$id]);
        
        if ($deleted) {
        return redirect()->route('pengaturan')->with('success', 'Kategori berhasil dihapus.');
        }
        
        return abort(404, 'Kategori tidak ditemukan');
    }

    public function destroyAllKategori()
    {
        // Periksa apakah ada kategori yang dimiliki pengguna
        $kategoriCount = DB::table('kategori_tugas')->where('user_id', Auth::id())->count();
    
        if ($kategoriCount > 0) {
            // Menghapus semua kategori jika ada
            DB::table('kategori_tugas')->where('user_id', Auth::id())->delete();
    
            return redirect()->route('pengaturan')->with('success', 'Semua kategori berhasil dihapus.');
        }
    
        // Jika tidak ada kategori yang ditemukan
        return redirect()->route('pengaturan')->with('info', 'Kategori sudah kosong.');
    }

    public function destroyRiwayat($id_pencarian)
    {
        $sql = "DELETE FROM riwayat_pencarian WHERE id_pencarian = ?";
        $deleted = DB::delete($sql, [$id_pencarian]);
        
        if ($deleted) {
        return redirect()->route('pengaturan')->with('success', 'Riwayat pencarian berhasil dihapus.');
        }
        
        return abort(404, 'Riwayat pencarian tidak ditemukan.');
    }

    public function destroyAllRiwayat()
    {
        // Periksa apakah ada kategori yang dimiliki pengguna
        $riwayatCount = DB::table('riwayat_pencarian')->where('id_user', Auth::id())->count();
    
        if ($riwayatCount > 0) {
            // Menghapus semua kategori jika ada
            DB::table('riwayat_pencarian')->where('id_user', Auth::id())->delete();
    
            return redirect()->route('pengaturan')->with('success', 'Semua riwayat pencarian berhasil dihapus.');
        }
    
        // Jika tidak ada kategori yang ditemukan
        return redirect()->route('pengaturan')->with('info', 'Tidak ada riwayat pencarian.');
    }

    public function destroye($id)
    {
        $sql = "DELETE FROM riwayat_emails WHERE id = ?";
        $deleted = DB::delete($sql, [$id]);
        
        if ($deleted) {
        return redirect()->route('pengaturan')->with('success', 'Riwayat email berhasil dihapus.');
        }
        
        return abort(404, 'Riwayat email tidak ditemukan.');
    }

    public function destroyAlle()
    {
        // Periksa apakah ada kategori yang dimiliki pengguna
        $riwayatCount = DB::table('riwayat_emails')->where('user_id', Auth::id())->count();
    
        if ($riwayatCount > 0) {
            // Menghapus semua kategori jika ada
            DB::table('riwayat_emails')->where('user_id', Auth::id())->delete();
    
            return redirect()->route('pengaturan')->with('success', 'Semua riwayat email berhasil dihapus.');
        }
    
        // Jika tidak ada kategori yang ditemukan
        return redirect()->route('pengaturan')->with('info', 'Riwayat email sudah kosong.');
    }
    
}