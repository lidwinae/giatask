<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id('id_tugas');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('nomor');
            $table->string('judul');
            $table->text('deskripsi')->nullable()->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci');
            $table->enum('prioritas', ['Tinggi', 'Sedang', 'Rendah']);
            $table->enum('status', ['selesai', 'belum selesai'])->default('belum selesai');
            $table->date('tanggal_tenggat')->nullable();
            $table->foreignId('kategori_tugas_id')->nullable()->constrained('kategori_tugas')->onDelete('set null');
            $table->primary('id_tugas');
            $table->index('user_id');
            $table->index('kategori_tugas_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
