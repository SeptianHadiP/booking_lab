<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduling_id',
        'nama',
        'foto_1',
        'foto_2',
        'absen_1',
        'absen_2',
    ];

    public function scheduling()
    {
        return $this->belongsTo(Schedulings::class, 'scheduling_id');
    }
}
