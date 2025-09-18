<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Loop untuk F1 - F8 dan A/B, lalu 1 - 8
        foreach (range(1, 8) as $f) {
            foreach (['A', 'B'] as $group) {
                foreach (range(1, 8) as $num) {
                    Kelas::create([
                        'nama_kelas' => "F{$f}{$group}{$num}"
                    ]);
                }
            }
        }

        // Tambah 'Other'
        Kelas::create([
            'nama_kelas' => 'Other'
        ]);
    }
}
