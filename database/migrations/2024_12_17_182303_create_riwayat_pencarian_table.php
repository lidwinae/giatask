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
            CREATE TABLE `riwayat_pencarian` (
            `id_pencarian` int NOT NULL AUTO_INCREMENT,
            `id_user` bigint unsigned NOT NULL,
            `text` varchar(255) NOT NULL,
            `waktu_pencarian` datetime NOT NULL,
            PRIMARY KEY (`id_pencarian`),
            KEY `id` (`id_user`),
            CONSTRAINT `riwayat_pencarian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pencarian');
    }
};
