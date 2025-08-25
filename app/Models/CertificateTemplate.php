<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateTemplate extends Model
{
    protected $fillable = [
        'name',
        'file_path',
        'font_color',

        'name_x_type',
        'name_x',
        'name_y_type',
        'name_y',

        'score_x_type',
        'score_x',
        'score_y_type',
        'score_y',

        'desc_x_type',
        'desc_x',
        'desc_y_type',
        'desc_y',
    ];

    protected $casts = [
        'name_x'   => 'integer',
        'name_y'   => 'integer',
        'score_x'  => 'integer',
        'score_y'  => 'integer',
        'desc_x'   => 'integer',
        'desc_y'   => 'integer',
    ];
}
