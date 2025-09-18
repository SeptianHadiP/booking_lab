<?php

namespace App\Http\Controllers;

use App\Models\Schedulings;
use App\Models\LaporanPraktikum;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Cari semester aktif sesuai tanggal hari ini
        $semesterAktif = Semester::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        // Ambil jadwal semester aktif
        $schedules = Schedulings::with([
                'user',
                'kelas',
                'laboratorium',
                'mata_kuliah_praktikum',
                'documentation',
            ])
            ->when($semesterAktif, fn($q) =>
                $q->whereBetween('tanggal_praktikum', [
                    $semesterAktif->start_date,
                    $semesterAktif->end_date,
                ])
            )
            ->get();

        // Ambil laporan semester aktif
        $lapraks = LaporanPraktikum::with([
                'user',
                'kelas',
                'mata_kuliah_praktikum',
                'semester',
            ])
            ->when($semesterAktif, fn($q) =>
                $q->where('semester_id', $semesterAktif->id)
            )
            ->get();

        // Filter progress tabel (maksimal 5, hanya yang belum)
        $schedulesBelum = $schedules
            ->filter(fn($s) => !$s->documentation)
            ->take(5);

        $lapraksBelum = $lapraks
            ->filter(function ($laprak) {
                $tahunAjaran = Str::slug($laprak->semester->tahun_ajar ?? date('Y'));
                $mataKuliah  = Str::slug($laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? 'mata-kuliah');
                $kelas       = Str::slug($laprak->kelas->nama_kelas ?? 'kelas');

                $basePath = "generated_certificates/{$tahunAjaran}/{$mataKuliah}/{$kelas}";
                $hasCertificate = Storage::disk('public')->exists($basePath);

                return !$laprak->nilai_file || !$hasCertificate;
            })
            ->take(5);

        return view('dashboard.dashboard', compact(
            'schedules',
            'lapraks',
            'schedulesBelum',
            'lapraksBelum',
            'semesterAktif'
        ));
    }
}
