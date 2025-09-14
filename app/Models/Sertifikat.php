<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    // protected $table = 'sertifikat'; 

    protected $fillable = [
        'laprak_id',
        'template_id',
    ];

    // Relasi ke LaporanPraktikum
    public function laporanPraktikum()
    {
        return $this->belongsTo(LaporanPraktikum::class, 'laprak_id');
    }

    // Relasi ke template sertifikat
    public function template()
    {
        return $this->belongsTo(CertificateTemplate::class, 'template_id');
    }

}
