<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanPraktikum extends Model
{
    use HasFactory;

    protected $table = 'laporan_praktikum';

    protected $fillable = [
        'user_id',
        'laporan_file',
        'kelas_id',
        'mata_kuliah_id',
        "semester_id",
        'nilai_file',
        'deskripsi',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mata_kuliah_praktikum()
    {
        return $this->belongsTo(MataKuliahPraktikum::class, 'mata_kuliah_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
}
