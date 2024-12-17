<?php

namespace App\Http\Controllers;

use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GmailController extends Controller
{
    public function index() // Menampilkan form dengan dropdown tugas
    {
        $sqlTugas = "
        SELECT t.*, kt.nama_kategori
        FROM tugas t
        LEFT JOIN kategori_tugas kt ON kt.id = t.kategori_tugas_id
        WHERE t.user_id = ?
        ";
    
        $tugasList = DB::select($sqlTugas, [
            Auth::id()
        ]);

        // Kirim data tugas ke view
        return view('gmail.gmail', compact('tugasList'));
    }

    public function pesan(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'tugas_id' => 'nullable|exists:tugas,id_tugas',
        ]);

        try {
            // Kirim email menggunakan Mail
            Mail::raw($validated['message'], function ($mail) use ($validated) {
                $mail->to($validated['to'])->subject($validated['subject']);
            });

            $inserted = DB::insert(
                'INSERT INTO riwayat_emails (user_id, tugas_id, `to`, `subject`, dikirim_pada) VALUES (?, ?, ?, ?, ?)',
                [
                    Auth::id(),
                    $validated['tugas_id'] ?? null,
                    $validated['to'],
                    $validated['subject'],
                    Carbon::now(),
                ]
            );
            if ($inserted) {
                return redirect()->back()->with('success', 'Email berhasil dikirim dan riwayat disimpan!');
            } else {
                return redirect()->back()->with('error', 'Ada masalah pada pengiriman email.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

}
