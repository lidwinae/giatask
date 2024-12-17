<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\GmailController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\FilterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/events', [KalenderController::class, 'getEvents']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/search',[TugasController::class,'search']);
Route::get('/list', [TugasController::class, 'list'])->name('list');

Route::get('/tugas', [TugasController::class, 'tugas'])->name('tugas');
Route::post('/tugas/store', [TugasController::class, 'store'])->name('tugas.store');
Route::get('/kategori', [TugasController::class, 'kategori'])->name('kategori');
Route::post('/kategori/store', [TugasController::class, 'kstore'])->name('kategori.store');

Route::put('/lidwina/{id_tugas}', [TugasController::class, 'update'])->name('tugas.update');
Route::delete('/eleonora/{id_tugas}', [TugasController::class, 'destroy'])->name('tugas.destroy');

Route::put('/dora/{id}/selesai', [TugasController::class, 'markAsCompleted'])->name('tugas.selesai');
Route::put('/dora/{id}/belum-selesai', [TugasController::class, 'unmarkAsCompleted'])->name('tugas.belum_selesai');

Route::get('/list/berlangsung', [TugasController::class, 'berlangsung'])->name('berlangsung');
Route::get('/list/terlewat', [TugasController::class, 'terlewat'])->name('terlewat');
Route::get('/list/selesai', [TugasController::class, 'selesai'])->name('selesai');

Route::get('/pengaturan', [PengaturanController::class, 'riwayat'])->name('pengaturan');
Route::put('/wina/{id}', [PengaturanController::class, 'update'])->name('kategori.update');
Route::delete('/eleo/{id}', [PengaturanController::class, 'destroy'])->name('kategori.destroy');
Route::delete('/nora', [PengaturanController::class, 'destroyAllKategori'])->name('kategori.destroy.all');
Route::delete('/maquina/{id_pencarian}', [PengaturanController::class, 'destroyRiwayat'])->name('riwayat.destroy');
Route::delete('/lancea', [PengaturanController::class, 'destroyAllRiwayat'])->name('riwayat.destroy.all');
Route::delete('/blackmara/{id}', [PengaturanController::class, 'destroye'])->name('riwayate.destroy');
Route::delete('/silverhunter', [PengaturanController::class, 'destroyAlle'])->name('riwayate.destroy.all');

Route::get('/gmail', [GmailController::class, 'index'])->name('gmail');
Route::post('/lidwinaeleonoradora', [GmailController::class, 'pesan'])->name('kirim.pesan');

Route::get('/list/nomor', [FilterController::class, 'nomor'])->name('nomor');
Route::get('/list/judul', [FilterController::class, 'judul'])->name('judul');
Route::get('/list/prioritas', [FilterController::class, 'prio'])->name('prio');
Route::get('/list/deskripsi', [FilterController::class, 'desk'])->name('desk');
Route::get('/list/kategori', [FilterController::class, 'kate'])->name('kate');

require __DIR__.'/auth.php';