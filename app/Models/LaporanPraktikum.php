<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanPraktikum extends Model
{
    use HasFactory;

    protected $table = 'laporan_praktikum';

    protected $fillable = [
        'laporan_file',
        'kelas',
        'semester',
        'nilai_file',
    ];
}
