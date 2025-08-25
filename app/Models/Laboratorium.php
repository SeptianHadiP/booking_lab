<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    protected $table = 'laboratorium'; // cocokkan dengan migration
    protected $fillable = ['nama_ruangan', 'jumlah_komputer'];
}
