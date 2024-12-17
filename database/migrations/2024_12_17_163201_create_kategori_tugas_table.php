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
        Schema::create('kategori_tugas', function (Blueprint $table) {
            $table->increments('id'); // Auto increment primary key
            $table->string('nama_kategori', 50); // Kolom nama_kategori
            $table->unsignedBigInteger('user_id')->nullable(); // Kolom user_id
            $table->primary('id'); // Primary key untuk kolom id
            $table->index('user_id'); // Index untuk kolom user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key ke tabel users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_tugas');
    }
};
