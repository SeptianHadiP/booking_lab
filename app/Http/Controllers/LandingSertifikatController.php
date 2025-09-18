<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingSertifikatController extends Controller
{
    public function index()
    {
        $tahunAjar = collect(Storage::disk('public')->directories('generated_certificates'))
            ->map(fn($dir) => basename($dir))
            ->toArray();

        // Struktur untuk Alpine
        $matkulsByTahun = [];
        $kelasByMatkul  = [];

        foreach ($tahunAjar as $tahun) {
            $matkuls = collect(Storage::disk('public')->directories("generated_certificates/{$tahun}"))
                ->map(fn($dir) => basename($dir))
                ->toArray();

            $matkulsByTahun[$tahun] = $matkuls;

            foreach ($matkuls as $mk) {
                $kelas = collect(Storage::disk('public')->directories("generated_certificates/{$tahun}/{$mk}"))
                    ->map(fn($dir) => basename($dir))
                    ->toArray();

                $kelasByMatkul[$tahun][$mk] = $kelas;
            }
        }

        return view('landing.sertifikat', compact(
            'tahunAjar',
            'matkulsByTahun',
            'kelasByMatkul'
        ));
    }

    public function filter(Request $request)
    {
        $tahun  = $request->tahun;
        $matkul = $request->matkul;
        $kelas  = $request->kelas;

        // Ambil semua tahun ajar untuk dropdown
        $tahunAjar = collect(Storage::disk('public')->directories('generated_certificates'))
            ->map(fn($dir) => basename($dir))
            ->toArray();

        $files = [];
        if ($tahun && $matkul && $kelas) {
            $basePath = "generated_certificates/{$tahun}/{$matkul}/{$kelas}";
            if (Storage::disk('public')->exists($basePath)) {
                $files = Storage::disk('public')->files($basePath);
            }
        }

        return view('landing.sertifikat', compact(
            'tahunAjar',
            'tahun',
            'matkul',
            'kelas',
            'files'
        ));
    }
}
