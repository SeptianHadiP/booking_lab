<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class SchedulingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create('id_ID');

        // // Ambil semua id dari tabel relasi
        // $kelasIds = DB::table('kelas')->pluck('id')->toArray();
        // $mataKuliahIds = DB::table('mata_kuliah_praktikum')->pluck('id')->toArray();
        // $labIds = DB::table('laboratorium')->pluck('id')->toArray();

        // $waktuSesi = [
        //     '08:00 - 09:40 (Sesi 1)',
        //     '10:00 - 11:40 (Sesi 2)',
        //     '13:00 - 14:40 (Sesi 3)',
        //     '15:00 - 16:40 (Sesi 4)',
        // ];

        // $data = [];
        // $usedCombos = []; // untuk simpan kombinasi unik

        // $limit = 100; // jumlah data dummy
        // $i = 0;

        // while ($i < $limit) {
        //     $tanggal = $faker->dateTimeBetween('-1 years', '+1 years')->format('Y-m-d');
        //     $labId = $faker->randomElement($labIds);
        //     $sesi = $faker->randomElement($waktuSesi);

        //     $comboKey = $tanggal . '-' . $labId . '-' . $sesi;

        //     // pastikan kombinasi belum dipakai
        //     if (!isset($usedCombos[$comboKey])) {
        //         $usedCombos[$comboKey] = true;

        //         $data[] = [
        //             'user_id' => 1,
        //             'kelas_id' => $faker->randomElement($kelasIds),
        //             'mata_kuliah_id' => $faker->randomElement($mataKuliahIds),
        //             'lab_id' => $labId,
        //             'tanggal_praktikum' => $tanggal,
        //             'waktu_praktikum' => $sesi,
        //             'modul_praktikum' => 'modul_praktikum/' . $faker->uuid . '.pdf',
        //             'judul_praktikum' => $faker->sentence(3),
        //             'deskripsi' => $faker->sentence(8),
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ];

        //         $i++;
        //     }
        // }

        // DB::table('schedulings')->insert($data);
    }
}
