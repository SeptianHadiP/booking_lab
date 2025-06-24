<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedulings extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dosen',
        'kelas',
        'mata_kuliah',
        'tanggal_praktikum',
        'waktu_praktikum',
        'modul_praktikum',
        'tools_software',
    ];

    // app/Models/Schedulings.php
    public function documentation()
    {
        return $this->hasOne(Documentation::class, 'scheduling_id');
    }
}
