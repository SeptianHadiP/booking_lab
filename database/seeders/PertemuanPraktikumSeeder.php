<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliahPraktikum;
use App\Models\PertemuanPraktikum;

class PertemuanPraktikumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Jumlah default pertemuan
        $jumlahPertemuanDefault = 4;

        $mataKuliahs = MataKuliahPraktikum::all();

        foreach ($mataKuliahs as $mataKuliah) {
            // Buat Pertemuan 1 sampai 4
            for ($i = 1; $i <= $jumlahPertemuanDefault; $i++) {
                PertemuanPraktikum::create([
                    'pertemuan' => 'Pertemuan ' . $i,
                    'mata_kuliah_praktikum_id' => $mataKuliah->id,
                ]);
            }

            // Tambahan opsi "Other"
            PertemuanPraktikum::create([
                'pertemuan' => 'Other',
                'mata_kuliah_praktikum_id' => $mataKuliah->id,
            ]);
        }
    }
}
