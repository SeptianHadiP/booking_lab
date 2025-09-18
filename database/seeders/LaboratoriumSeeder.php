<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laboratorium;

class LaboratoriumSeeder extends Seeder
{
    public function run(): void
    {
        $labs = [
            ['nama_ruangan' => 'Lab Software Development', 'jumlah_komputer' => 15],
            ['nama_ruangan' => 'Lab Data Science', 'jumlah_komputer' => 20],
            ['nama_ruangan' => 'Lab Network & Cyber Security', 'jumlah_komputer' => 30],
        ];
        foreach ($labs as $lab) {
            Laboratorium::create($lab);
        }
    }
}
