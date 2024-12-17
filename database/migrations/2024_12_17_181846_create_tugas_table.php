<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE TABLE `tugas` (
            `id_tugas` int NOT NULL AUTO_INCREMENT,
            `user_id` bigint unsigned NOT NULL,
            `nomor` int NOT NULL,
            `judul` varchar(255) NOT NULL,
            `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
            `prioritas` enum('Tinggi','Sedang','Rendah') NOT NULL,
            `status` enum('selesai','belum selesai') DEFAULT 'belum selesai',
            `tanggal_tenggat` date DEFAULT NULL,
            `kategori_tugas_id` int DEFAULT NULL,
            PRIMARY KEY (`id_tugas`),
            KEY `id` (`user_id`),
            KEY `fk_kategori_tugas` (`kategori_tugas_id`),
            CONSTRAINT `fk_kategori_tugas` FOREIGN KEY (`kategori_tugas_id`) REFERENCES `kategori_tugas` (`id`) ON DELETE SET NULL,
            CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
