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
        Schema::create('riwayat_tugas', function (Blueprint $table) {
            $table->increments('id_riwayat'); // Auto increment primary key
            $table->unsignedInteger('id_tugas'); // Kolom id_tugas
            $table->dateTime('selesai_pada'); // Kolom selesai_pada
            $table->primary('id_riwayat'); // Primary key untuk kolom id_riwayat
            $table->index('id_tugas'); // Index untuk kolom id_tugas
            $table->foreign('id_tugas')->references('id_tugas')->on('tugas')->onDelete('cascade'); // Foreign key ke tabel tugas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_tugas');
    }
};
