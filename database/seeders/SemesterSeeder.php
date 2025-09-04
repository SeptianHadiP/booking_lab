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
        // $semesters = [
        //     ['20241', '2024/2025 Ganjil', '2024-09-01', '2025-03-31'],
        //     ['20242', '2024/2025 Genap',  '2025-04-01', '2025-08-31'],
        //     ['20251', '2025/2026 Ganjil', '2025-09-01', '2026-03-31'],
        //     ['20252', '2025/2026 Genap',  '2026-04-01', '2026-08-31'],
        //     ['20261', '2026/2027 Ganjil', '2026-09-01', '2027-03-31'],
        //     ['20262', '2026/2027 Genap',  '2027-04-01', '2027-08-31'],
        //     ['20271', '2027/2028 Ganjil', '2027-09-01', '2028-03-31'],
        //     ['20272', '2027/2028 Genap',  '2028-04-01', '2028-08-31'],
        //     ['20281', '2028/2029 Ganjil', '2028-09-01', '2029-03-31'],
        //     ['20282', '2028/2029 Genap',  '2029-04-01', '2029-08-31'],
        //     ['20291', '2029/2030 Ganjil', '2029-09-01', '2030-03-31'],
        //     ['20292', '2029/2030 Genap',  '2030-04-01', '2030-08-31'],
        //     ['20301', '2030/2031 Ganjil', '2030-09-01', '2031-03-31'],
        //     ['20302', '2030/2031 Genap',  '2031-04-01', '2031-08-31'],
        // ];

        // foreach ($semesters as [$id, $name, $start, $end]) {
        //     Semester::updateOrCreate(
        //         ['id' => $id],
        //         [
        //             'name'       => $name,
        //             'start_date' => Carbon::parse($start),
        //             'end_date'   => Carbon::parse($end),
        //         ]
        //     );
        // }
    }
}
