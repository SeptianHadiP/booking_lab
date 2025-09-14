<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPraktikum;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\MataKuliahPraktikum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LaporanPraktikumController extends Controller
{
    public function index()
    {
        $lapraks = LaporanPraktikum::with(['kelas', 'mata_kuliah_praktikum', 'semester', 'user'])
            ->latest()
            ->get();

        return view('dashboard.pages.laporan_pratikum.index', compact('lapraks'));
    }

    public function create()
    {
        $kelasList      = Kelas::orderBy('nama_kelas')->get();
        $mataKuliahList = MataKuliahPraktikum::orderBy('nama_mata_kuliah')->get();
        $semesterList   = Semester::orderBy('start_date', 'desc')->get();

        return view('dashboard.pages.laporan_pratikum.create-laprak', compact(
            'kelasList',
            'mataKuliahList',
            'semesterList'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'laporan_file'   => 'required|mimes:pdf,doc,docx|max:5120',
            'kelas_id'       => 'required|exists:kelas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah_praktikum,id',
            'semester_id'    => 'required|exists:semesters,id',
            'nilai_file'     => 'required|mimes:xlsx,xls,csv|max:5120',
            'deskripsi'      => 'nullable|string',
        ]);

        try {
            $laporanPath = $request->file('laporan_file')->store('laporan', 'public');
            $nilaiPath   = $request->file('nilai_file')->store('nilai', 'public');

            LaporanPraktikum::create([
                'user_id'        => Auth::id(),
                'laporan_file'   => $laporanPath,
                'kelas_id'       => $request->kelas_id,
                'mata_kuliah_id' => $request->mata_kuliah_id,
                'semester_id'    => $request->semester_id,
                'nilai_file'     => $nilaiPath,
                'deskripsi'      => $request->deskripsi,
            ]);

            return redirect()
                ->route('laprak.index')
                ->with('success', 'Laporan praktikum berhasil diupload!');
        } catch (\Exception $e) {
            Log::error('Gagal upload laporan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan laporan!');
        }
    }

    public function show($id)
    {
        $laprak = LaporanPraktikum::with(['kelas', 'mata_kuliah_praktikum', 'semester', 'user'])
            ->findOrFail($id);

        return view('dashboard.pages.laporan_pratikum.show-laprak', compact('laprak'));
    }

    public function edit($id)
    {
        $laprak = LaporanPraktikum::with(['kelas', 'mata_kuliah_praktikum', 'semester', 'user'])
            ->findOrFail($id);

        $kelasList      = Kelas::orderBy('nama_kelas')->get();
        $mataKuliahList = MataKuliahPraktikum::orderBy('nama_mata_kuliah')->get();
        $semesterList   = Semester::orderBy('start_date', 'desc')->get();

        return view('dashboard.pages.laporan_pratikum.update-laprak', compact(
            'laprak',
            'kelasList',
            'mataKuliahList',
            'semesterList'
        ));
    }

    public function update(Request $request, $id)
    {
        $laprak = LaporanPraktikum::findOrFail($id);

        $request->validate([
            'laporan_file'   => 'nullable|mimes:pdf,doc,docx|max:5120',
            'kelas_id'       => 'required|exists:kelas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah_praktikum,id',
            'semester_id'    => 'required|exists:semesters,id',
            'nilai_file'     => 'nullable|mimes:xlsx,xls,csv|max:5120',
            'deskripsi'      => 'nullable|string',
        ]);

        try {
            $data = $request->only(['kelas_id', 'mata_kuliah_id', 'semester_id', 'deskripsi']);

            // replace laporan_file jika ada
            if ($request->hasFile('laporan_file')) {
                if ($laprak->laporan_file && Storage::disk('public')->exists($laprak->laporan_file)) {
                    Storage::disk('public')->delete($laprak->laporan_file);
                }
                $data['laporan_file'] = $request->file('laporan_file')->store('laporan', 'public');
            }

            // replace nilai_file jika ada
            if ($request->hasFile('nilai_file')) {
                if ($laprak->nilai_file && Storage::disk('public')->exists($laprak->nilai_file)) {
                    Storage::disk('public')->delete($laprak->nilai_file);
                }
                $data['nilai_file'] = $request->file('nilai_file')->store('nilai', 'public');
            }

            $laprak->update($data);

            return redirect()
                ->route('laprak.index')
                ->with('success', 'Laporan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Gagal update laporan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui laporan!');
        }
    }

    public function destroy($id)
    {
        $laprak = LaporanPraktikum::findOrFail($id);

        try {
            if ($laprak->laporan_file && Storage::disk('public')->exists($laprak->laporan_file)) {
                Storage::disk('public')->delete($laprak->laporan_file);
            }
            if ($laprak->nilai_file && Storage::disk('public')->exists($laprak->nilai_file)) {
                Storage::disk('public')->delete($laprak->nilai_file);
            }

            $laprak->delete();

            return redirect()
                ->route('laprak.index')
                ->with('success', 'Laporan berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal hapus laporan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus laporan!');
        }
    }
    public function certificates($id)
    {
        $laprak = LaporanPraktikum::with(['kelas', 'mata_kuliah_praktikum', 'semester', 'user'])
            ->findOrFail($id);

        $tahunAjaran = Str::slug($laprak->semester->tahun_ajar ?? date('Y'));
        $mataKuliah  = Str::slug($laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? 'mata-kuliah');
        $kelas       = Str::slug($laprak->kelas->nama_kelas ?? 'kelas');

        $basePath = "generated_certificates/{$tahunAjaran}/{$mataKuliah}/{$kelas}";
        $certificateFiles = Storage::disk('public')->exists($basePath)
            ? Storage::disk('public')->files($basePath)
            : [];

        return view('dashboard.pages.laporan_pratikum.certificates', compact('laprak', 'certificateFiles'));
    }

}
