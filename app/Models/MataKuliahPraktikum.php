<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliahPraktikum extends Model
{
    protected $table = 'mata_kuliah_praktikum';

    protected $fillable = ['nama_mata_kuliah'];

    // public function schedule()
    // {
    //     return $this->belongsTo(Schedulings::class, 'scheduling_id');
    // }
}
