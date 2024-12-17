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
        Schema::create('riwayat_pencarian', function (Blueprint $table) {
            $table->increments('id_pencarian'); // Auto increment primary key
            $table->unsignedBigInteger('id_user'); // Kolom id_user (bigint unsigned)
            $table->string('text'); // Kolom text (varchar(255))
            $table->dateTime('waktu_pencarian'); // Kolom waktu_pencarian (datetime)

            // Primary Key
            $table->primary('id_pencarian');

            // Index
            $table->index('id_user');

            // Foreign Key
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pencarian');
    }
};
