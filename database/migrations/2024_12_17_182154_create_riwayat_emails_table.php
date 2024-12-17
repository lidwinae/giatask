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
        Schema::create('riwayat_emails', function (Blueprint $table) {
            $table->increments('id'); // Auto increment primary key
            $table->unsignedBigInteger('user_id'); // Kolom user_id (bigint unsigned)
            $table->unsignedInteger('tugas_id')->nullable(); // Kolom tugas_id (int unsigned, nullable)
            $table->string('to'); // Kolom to (varchar(255))
            $table->string('subject'); // Kolom subject (varchar(255))
            $table->timestamp('dikirim_pada')->nullable()->default(DB::raw('CURRENT_TIMESTAMP')); // Kolom dikirim_pada (timestamp dengan default CURRENT_TIMESTAMP)

            // Primary Key
            $table->primary('id');

            // Index
            $table->index('user_id');
            $table->index('tugas_id');

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tugas_id')->references('id_tugas')->on('tugas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_emails');
    }
};
