<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertemuanPraktikum extends Model
{
    protected $table = 'pertemuan_praktikum';

    protected $fillable = ['pertemuan', 'mata_kuliah_praktikum_id'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliahPraktikum::class, 'mata_kuliah_praktikum_id');
    }
}
