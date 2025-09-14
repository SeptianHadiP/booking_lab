<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedulings;
use App\Models\LaporanPraktikum;
use App\Models\Sertifikat;
use App\Models\Kelas;
use App\Models\MataKuliahPraktikum;

class KalabDashboardController extends Controller
{
    public function index()
    {
        // Total Jadwal Praktikum
        $totalJadwal = Schedulings::count();

        // Total Laporan Praktikum
        $totalLaporan = LaporanPraktikum::count();

        // Total Sertifikat
        $totalSertifikat = Sertifikat::count();

        // Persentase penggunaan lab
        $totalLab = 10; // ganti sesuai jumlah lab di database
        $labDigunakan = Schedulings::count();
        $persentaseLab = $totalLab ? round(($labDigunakan / $totalLab) * 100, 2) : 0;

        // Rekap laporan praktikum
        $laporanRaw = LaporanPraktikum::with(['kelas', 'mata_kuliah_praktikum', 'user'])->get();

        $laporan = $laporanRaw->map(function($item) {
            $sertifikat = $item->sertifikat ?? null;
            return [
                'mata_kuliah' => $item->mata_kuliah_praktikum->nama_mata_kuliah ?? '-',
                'dosen' => $item->user->name ?? '-',
                'aslab' => $item->kelas->documentation->schedule->user->name ?? '-', // ambil Aslab dari documentation
                'jumlah_pertemuan' => $item->pertemuan_praktikum_count ?? 0,
                'status_laporan' => $item->laporan_file ? 'sudah' : 'belum',
                'link_sertifikat' => $sertifikat ? route('sertifikat.show', $sertifikat->id) : null,
            ];
        });

        return view('dashboard.dashboard', compact(
            'totalJadwal',
            'totalLaporan',
            'totalSertifikat',
            'persentaseLab',
            'laporan'
        ));
    }
}
