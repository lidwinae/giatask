<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    // Definisikan konstanta
    const PRIORITAS_RENDAH = 'Rendah';
    const PRIORITAS_SEDANG = 'Sedang';
    const PRIORITAS_TINGGI = 'Tinggi';
    const STATUS_SELESAI = 'selesai';
    const STATUS_BELUMSELESAI = 'belum selesai';

    // Daftar prioritas yang valid
    public static function validPrioritas()
    {
        return [
            self::PRIORITAS_TINGGI,
            self::PRIORITAS_SEDANG,
            self::PRIORITAS_RENDAH,
        ];
    }

    public static function validStatus()
    {
        return [
            self::STATUS_SELESAI,
            self::STATUS_BELUMSELESAI,
        ];
    }

    public function kategori_tugas(){
        return $this->belongsTo(KategoriTugas::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'nomor',
        'judul',
        'deskripsi',
        'prioritas',
        'status',
        'tanggal_tenggat',
        'kategori_tugas_id',
    ];
}