<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliahPraktikum;

class MataKuliahPraktikumSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Fisika Dasar',
            'Pengantar Sistem Digital',
            'Analisis Numerik',
            'Pembelajaran Mesin',
            'Jaringan Komputer',
            'Keamanan Siber',
            'Other'
        ];

        foreach ($data as $item) {
            MataKuliahPraktikum::create([
                'nama_mata_kuliah' => $item
            ]);
        }
    }
}
