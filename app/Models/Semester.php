<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Schedulings;
use Carbon\Carbon;

class Semester extends Model
{
    // use HasFactory;

    // // Primary key pakai id (contoh: 20251, 20252)
    // protected $primaryKey = 'id';
    // public $incrementing = false; // supaya bisa pakai custom id
    // protected $keyType = 'int';

    // protected $fillable = [
    //     'id',          // contoh: 20251
    //     'name',        // contoh: 2025/2026 Ganjil
    //     'start_date',
    //     'end_date',
    // ];

    // // Scope untuk semester aktif otomatis (berdasarkan tanggal hari ini)
    // public function scopeActive($query)
    // {
    //     $today = Carbon::today();
    //     return $query->where('start_date', '<=', $today)
    //                  ->where('end_date', '>=', $today);
    // }

    // // Relasi ke schedulings
    // public function schedulings()
    // {
    //     return $this->hasMany(Schedulings::class, 'semester_id', 'id');
    // }
}
