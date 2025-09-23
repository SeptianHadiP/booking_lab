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
            // Semester I
            'Kewarganegaraan',
            'Character Building',
            'Fisika',
            'Kalkulus I',
            'Dasar Pemrograman',
            'Struktur Data dan Algoritma',
            'Pengantar Teknologi Informasi',
            'Aljabar Linier',

            // Semester II
            'Bahasa Indonesia',
            'Pendidikan Agama',
            'Kalkulus II',
            'Logika Matematika',
            'Matematika Diskrit',
            'Desain dan Analisis Algoritma',
            'Sistem Basis Data',

            // Semester III
            'Pancasila',
            'Jaringan Komputer I',
            'Pemrograman Berorientasi Objek',
            'Analisa Numerik',
            'Sistem Operasi',
            'Pengantar Sistem Digital',
            'Pengantar Data Sains',
            'Rekayasa Perangkat Lunak',

            // Semester IV
            'Bahasa Inggris',
            'Pengantar Keamanan Komputer',
            'Analisa dan Desain Berorientasi Objek',
            'Teori Bahasa dan Otomata',
            'Jaringan Komputer II',
            'Statistika dan Probabilitas',
            'Pemrograman Web',
            'Pengantar Organisasi Komputer',

            // Semester V
            'Manajemen Sekuriti',
            'Pembelajaran Mesin',
            'Interaksi Manusia dan Komputer',
            'Pemrograman Perangkat Bergerak',
            'Kecerdasan Buatan',
            'Keamanan Siber',
            'Manajemen Proyek Perangkat Lunak',

            // Semester VI
            'Riset Teknologi Informasi',
            'Data Mining',
            'Desain dan Implementasi',
            'Kerja Praktik',
            'Technoprenuership',
            'Business Intelligence',
            'Pengenalan Pola',
            'Database Lanjut',
            'Pemrograman Berbasis Framework',
            'Jaringan Nirkabel',
            'Komputer Forensik',

            // Semester VII
            'Intelijen Ekonomi',
            'KKN',
            'Etika Profesi',
            'Big Data',
            'Pengolah Bahasa Alami',
            'Deep Learning',
            'Tata Kelola IT',
            'Sistem Pendukung Keputusan',
            'Pengolahan Citra Digital',
            'Teknologi IoT',
            'Keamanan Informasi dan Jaringan',
            'Cloud Computing',

            // Semester VIII
            'Skripsi / Tugas Akhir',
        ];

        foreach ($data as $item) {
            MataKuliahPraktikum::create([
                'nama_mata_kuliah' => $item
            ]);
        }
    }
}
