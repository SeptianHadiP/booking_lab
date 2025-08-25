<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPraktikum;
use Illuminate\Support\Facades\Log;

class LaporanPraktikumController extends Controller
{
    public function create()
    {
        // Misal daftar kelas bisa dari DB, sementara kita buat array
        $kelasList = ['IF-1', 'IF-2', 'IF-3', 'SI-1', 'SI-2'];

        return view('dashboard.pages.laporan_pratikum.create-laprak', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'laporan_file' => 'required|mimes:pdf,doc,docx|max:5120',
            'kelas'        => 'required|string|max:50',
            'semester'     => 'required|in:Ganjil,Genap',
            'nilai_file'   => 'required|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            // Simpan laporan
            $laporanPath = $request->file('laporan_file')->store('laporan', 'public');

            // Simpan nilai excel
            $nilaiPath = $request->file('nilai_file')->store('nilai', 'public');

            // Insert ke DB
            LaporanPraktikum::create([
                'laporan_file' => $laporanPath,
                'kelas'        => $request->kelas,
                'semester'     => $request->semester,
                'nilai_file'   => $nilaiPath,
            ]);

            return redirect()->back()->with('success', 'Laporan praktikum berhasil diupload!');
        } catch (\Exception $e) {
            Log::error('Gagal upload laporan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan laporan!');
        }
    }

    // public function index()
    // {
    //     $laporanList = LaporanPraktikum::latest()->get();
    //     return view('dashboard.pages.laporan.index', compact('laporanList'));
    // }

    public function destroy($id)
    {
        try {
            $laporan = LaporanPraktikum::findOrFail($id);

            // Hapus file
            if ($laporan->laporan_file && file_exists(storage_path('app/public/' . $laporan->laporan_file))) {
                unlink(storage_path('app/public/' . $laporan->laporan_file));
            }
            if ($laporan->nilai_file && file_exists(storage_path('app/public/' . $laporan->nilai_file))) {
                unlink(storage_path('app/public/' . $laporan->nilai_file));
            }

            $laporan->delete();

            return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal hapus laporan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus laporan!');
        }
    }
}
