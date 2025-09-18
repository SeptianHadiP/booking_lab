<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Schedulings;
use Carbon\Carbon;

class Semester extends Model
{
    protected $fillable = ['id', 'tahun_ajar', 'start_date', 'end_date'];

    public function scopeAktif($query)
    {
        $today = Carbon::today();
        return $query->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today);
    }

    public static function getAktif()
    {
        return self::aktif()->first();
    }
}
