<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laboratorium;

class LaboratoriumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labs = [
            ['nama_ruangan' => 'Lab Software Development', 'jumlah_komputer' => 15],
            ['nama_ruangan' => 'Lab Data Science', 'jumlah_komputer' => 20],
            ['nama_ruangan' => 'Lab Network & Cyber Security', 'jumlah_komputer' => 30],
        ];
//  $semester = [
//             ['20131' => '2013 / 2014 Ganji', '01 sept 2013' => '31 maret 2014'],
//             ['20132' => '2013 / 2014 Genap', '01 April 2014' => '31 Agust 2014'],
//             ['20141' => '2014 / 2015 Ganji', '01 sept 2014' => '31 maret 2015'],
//             ['20142' => '2014 / 2015 Genap', '01 April 2015' => '31 Agust 2015'],
//             ['20151' => '2015 / 2016 Ganji', '01 sept 2015' => '31 maret 2016'],
//             ['20152' => '2015 / 2016 Genap', '01 April 2016' => '31 Agust 2016'],
//             ['20161' => '2016 / 2017 Ganji', '01 sept 2016' => '31 maret 2017'],
//             ['20162' => '2016 / 2017 Genap', '01 April 2017' => '31 Agust 2017'],
//             ['20171' => '2017 / 2018 Ganji', '01 sept 2017' => '31 maret 2018'],
//             ['20172' => '2017 / 2018 Genap', '01 April 2018' => '31 Agust 2018'],
//             ['20181' => '2018 / 2019 Ganji', '01 sept 2018' => '31 maret 2019'],
//             ['20182' => '2018 / 2019 Genap', '01 April 2019' => '31 Agust 2019'],
//             ['20191' => '2019 / 2020 Ganji', '01 sept 2020' => '31 maret 2020'],
//             ['20202' => '2020 / 2021 Genap', '01 April 2021' => '31 Agust 2021'],
//             ['20211' => '2021 / 2022 Ganji', '01 sept 2021' => '31 maret 2022'],
//             ['20212' => '2021 / 2022 Genap', '01 April 2022' => '31 Agust 2022'],
//             ['20221' => '2022 / 2023 Ganji', '01 sept 2022' => '31 maret 2023'],
//             ['20222' => '2022 / 2023 Genap', '01 April 2023' => '31 Agust 2023'],
//             ['20231' => '2023 / 2024 Ganji', '01 sept 2023' => '31 maret 2024'],
//             ['20232' => '2023 / 2024 Genap', '01 April 2024' => '31 Agust 2024'],
//             ['20241' => '2024 / 2025 Ganji', '01 sept 2024' => '31 maret 2025'],
//             ['20242' => '2024 / 2025 Genap', '01 April 2025' => '31 Agust 2025'],
//             ['20251' => '2025 / 2026 Genap', '01 Sept 2025' => '31 Maret 2026'],
//             ['20252' => '2025 / 2026 Genap', '01 April 2026' => '31 Agust 2026'],
//         ];
        foreach ($labs as $lab) {
            Laboratorium::create($lab);
        }
    }
}
