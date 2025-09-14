<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingSertifikatController extends Controller
{
    public function index()
    {
        $tahunAjar = Storage::disk('public')->directories('generated_certificates');
        $tahunAjar = array_map(fn($dir) => basename($dir), $tahunAjar);

        // siapkan struktur untuk Alpine
        $matkulsByTahun = [];
        $kelasByMatkul  = [];

        foreach ($tahunAjar as $tahun) {
            $matkuls = Storage::disk('public')->directories("generated_certificates/{$tahun}");
            $matkuls = array_map('basename', $matkuls);
            $matkulsByTahun[$tahun] = $matkuls;

            foreach ($matkuls as $mk) {
                $kelas = Storage::disk('public')->directories("generated_certificates/{$tahun}/{$mk}");
                $kelas = array_map('basename', $kelas);
                $kelasByMatkul[$tahun][$mk] = $kelas;
            }
        }

        return view('landing.sertifikat', compact('tahunAjar', 'matkulsByTahun', 'kelasByMatkul'));
    }


    public function filter(Request $request)
    {
        $tahun   = $request->tahun;
        $matkul  = $request->matkul;
        $kelas   = $request->kelas;

        // Ambil semua tahun ajar untuk dropdown
        $tahunAjar = Storage::disk('public')->directories('generated_certificates');
        $tahunAjar = array_map(fn($dir) => basename($dir), $tahunAjar);

        $files = [];
        if ($tahun && $matkul && $kelas) {
            $basePath = "generated_certificates/{$tahun}/{$matkul}/{$kelas}";
            if (Storage::disk('public')->exists($basePath)) {
                $files = Storage::disk('public')->files($basePath);
            }
        }

        return view('landing.sertifikat', compact('tahunAjar', 'tahun', 'matkul', 'kelas', 'files'));
    }
}
