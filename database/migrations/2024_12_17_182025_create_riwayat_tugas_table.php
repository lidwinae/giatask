<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE TABLE `riwayat_tugas` (
            `id_riwayat` int NOT NULL AUTO_INCREMENT,
            `id_tugas` int NOT NULL,
            `selesai_pada` datetime NOT NULL,
            PRIMARY KEY (`id_riwayat`),
            KEY `id_tugas` (`id_tugas`),
            CONSTRAINT `riwayat_tugas_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_tugas');
    }
};
