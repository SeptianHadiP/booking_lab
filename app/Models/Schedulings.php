<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedulings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ganti dari nama_dosen → user_id
        'kelas_id',
        'mata_kuliah_id',
        'tanggal_praktikum',
        'waktu_praktikum',
        'modul_praktikum',
        'judul_praktikum',
        'deskripsi',
        'lab_id',
    ];

    // Relasi ke User (Dosen)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Dokumentasi
    public function documentation()
    {
        return $this->hasOne(Documentation::class, 'scheduling_id');
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke Mata Kuliah
    public function mata_kuliah_praktikum()
    {
        return $this->belongsTo(MataKuliahPraktikum::class, 'mata_kuliah_id');
    }

    // Relasi ke Laboratorium
    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class, 'lab_id');
    }
}
