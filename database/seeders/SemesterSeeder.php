<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semester;
use Carbon\Carbon;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startYear = 2024; // titik awal
        $totalYears = 10;   // generate 10 tahun ke depan

        for ($i = 0; $i < $totalYears; $i++) {
            $year = $startYear + $i;

            $ganjilId = $year . '1';
            Semester::updateOrCreate(
                ['id' => $ganjilId],
                [
                    'tahun_ajar' => $year . '/' . ($year + 1) . ' Ganjil',
                    'start_date' => Carbon::create($year, 9, 1),
                    'end_date'   => Carbon::create($year + 1, 3, 31),
                ]
            );

            // Semester Genap (2)
            $genapId = $year . '2';
            Semester::updateOrCreate(
                ['id' => $genapId],
                [
                    'tahun_ajar' => $year . '/' . ($year + 1) . ' Genap',
                    'start_date' => Carbon::create($year + 1, 4, 1),
                    'end_date'   => Carbon::create($year + 1, 8, 31),
                ]
            );
        }
    }
}
