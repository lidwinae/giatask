<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTugas extends Model
{
    use HasFactory;

    public function tugass(){
        return $this->hasMany(Tugas::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['nama_kategori', 'user_id'];
}