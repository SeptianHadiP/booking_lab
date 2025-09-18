<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedulings;
use App\Models\Kelas;
use App\Models\Laboratorium;
use App\Models\MataKuliahPraktikum;
use App\Models\Semester;
use App\Models\User;
use App\Notifications\EmailSubmitSchedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SchedulingsController extends Controller
{
    private function generateModulPath($semester, $lab, $mataKuliah, $tanggal, $waktu)
    {
        $tahunAjar   = Str::slug(str_replace('/', '-', $semester->tahun_ajar ?? date('Y', strtotime($semester->start_date))));
        $namaLab     = Str::slug($lab->nama_ruangan ?? 'lab'); // pakai nama_ruangan biar konsisten
        $namaMatkul  = Str::slug($mataKuliah->nama_mata_kuliah ?? 'mata-kuliah');
        preg_match('/\((.*?)\)/', $waktu, $matches);
        $sesi = isset($matches[1]) ? Str::slug($matches[1]) : Str::slug($waktu);

        return "assets/modul_praktikum/{$tahunAjar}/{$namaLab}/{$namaMatkul}/{$sesi}";
    }

    public function index()
    {
        $schedules = Schedulings::with('documentation')->get();
        return view('dashboard.pages.schedulings.index', compact('schedules'));
    }

    public function show($id)
    {
        $schedule = Schedulings::with(['user', 'kelas', 'mata_kuliah_praktikum', 'laboratorium', 'documentation'])
            ->findOrFail($id);

        return view('dashboard.pages.schedulings.show-scheduling', compact('schedule'));
    }

    public function create()
    {
        $kelasList = Kelas::all();
        $schedule = null;
        $mataKuliahList = MataKuliahPraktikum::all();
        $labList = Laboratorium::all();

        return view('dashboard.pages.schedulings.create-scheduling', compact('kelasList', 'mataKuliahList', 'schedule', 'labList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id'          => 'required|string|max:20',
            'mata_kuliah_id'    => 'required|string',
            'lab_id'            => 'required|string',
            'tanggal_praktikum' => 'required|date',
            'waktu_praktikum'   => 'required|string',
            'modul_praktikum'   => 'required|mimes:pdf,doc,docx|max:2048',
            'judul_praktikum'   => 'required|string|max:255',
            'deskripsi'         => 'required|string',
        ]);

        $semester = Semester::where('start_date', '<=', $request->tanggal_praktikum)
            ->where('end_date', '>=', $request->tanggal_praktikum)
            ->first();

        if (!$semester) {
            return back()->withErrors([
                'tanggal_praktikum' => 'Tanggal yang dipilih tidak termasuk dalam semester aktif.'
            ])->withInput();
        }

        $bentrok = Schedulings::where('tanggal_praktikum', $request->tanggal_praktikum)
            ->where('waktu_praktikum', $request->waktu_praktikum)
            ->where('lab_id', $request->lab_id)
            ->exists();

        if ($bentrok) {
            return back()->withErrors([
                'tanggal_praktikum' => 'Jadwal sudah digunakan pada waktu tersebut.'
            ])->withInput();
        }

        $lab        = Laboratorium::findOrFail($request->lab_id);
        $mataKuliah = MataKuliahPraktikum::findOrFail($request->mata_kuliah_id);

        $path = $this->generateModulPath($semester, $lab, $mataKuliah, $request->tanggal_praktikum, $request->waktu_praktikum);
        $modulPath = $request->file('modul_praktikum')->store($path, 'public');

        $schedule = Schedulings::create([
            'user_id'           => Auth::id(),
            'kelas_id'          => $request->kelas_id,
            'mata_kuliah_id'    => $request->mata_kuliah_id,
            'lab_id'            => $request->lab_id,
            'semester_id'       => $semester->id,
            'tanggal_praktikum' => $request->tanggal_praktikum,
            'waktu_praktikum'   => $request->waktu_praktikum,
            'modul_praktikum'   => $modulPath,
            'judul_praktikum'   => $request->judul_praktikum,
            'deskripsi'         => $request->deskripsi,
        ]);

        return redirect()->route('schedulings.create')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $schedule = Schedulings::findOrFail($id);
        $kelasList = Kelas::all();
        $mataKuliahList = MataKuliahPraktikum::all();
        $labList = Laboratorium::all();

        return view('dashboard.pages.schedulings.create-scheduling', compact('kelasList', 'mataKuliahList', 'schedule', 'labList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kelas_id'          => 'required|string|max:255',
            'mata_kuliah_id'    => 'required|string',
            'lab_id'            => 'required|string',
            'tanggal_praktikum' => 'required|date',
            'waktu_praktikum'   => 'required|string',
            'judul_praktikum'   => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'modul_praktikum'   => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $semester = Semester::where('start_date', '<=', $request->tanggal_praktikum)
            ->where('end_date', '>=', $request->tanggal_praktikum)
            ->first();

        if (!$semester) {
            return back()->withErrors([
                'tanggal_praktikum' => 'Tanggal yang dipilih tidak termasuk dalam semester aktif.'
            ])->withInput();
        }

        $conflict = Schedulings::where('tanggal_praktikum', $request->tanggal_praktikum)
            ->where('waktu_praktikum', $request->waktu_praktikum)
            ->where('lab_id', $request->lab_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors([
                'tanggal_praktikum' => 'Tanggal dan waktu praktikum sudah terpakai.'
            ])->withInput();
        }

        $schedule = Schedulings::findOrFail($id);

        $schedule->update([
            'user_id'           => Auth::id(),
            'kelas_id'          => $request->kelas_id,
            'mata_kuliah_id'    => $request->mata_kuliah_id,
            'lab_id'            => $request->lab_id,
            'semester_id'       => $semester->id,
            'tanggal_praktikum' => $request->tanggal_praktikum,
            'waktu_praktikum'   => $request->waktu_praktikum,
            'judul_praktikum'   => $request->judul_praktikum,
            'deskripsi'         => $request->deskripsi,
        ]);

        if ($request->hasFile('modul_praktikum')) {
            if ($schedule->modul_praktikum && Storage::disk('public')->exists($schedule->modul_praktikum)) {
                Storage::disk('public')->delete($schedule->modul_praktikum);
            }

            $lab        = Laboratorium::findOrFail($request->lab_id);
            $mataKuliah = MataKuliahPraktikum::findOrFail($request->mata_kuliah_id);

            $path = $this->generateModulPath($semester, $lab, $mataKuliah, $request->tanggal_praktikum, $request->waktu_praktikum);
            $file = $request->file('modul_praktikum')->store($path, 'public');

            $schedule->modul_praktikum = $file;
            $schedule->save();
        }

        return redirect()->route('schedulings.edit', $id)->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $schedule = Schedulings::with('documentation')->findOrFail($id);

        // hapus semua dokumentasi & file foto
        if ($schedule->documentation->count() > 0) {
            foreach ($schedule->documentation as $doc) {
                foreach (['foto_1', 'foto_2', 'absen_1', 'absen_2'] as $field) {
                    if (!empty($doc->$field) && Storage::disk('public')->exists($doc->$field)) {
                        Storage::disk('public')->delete($doc->$field);
                    }
                }
                $doc->delete();
            }

            // hapus folder dokumentasi (jika ada)
            $docFolder = $this->generateDocumentationFolder($schedule);
            $this->deleteFolderIfExists($docFolder);
        }

        // hapus modul praktikum (jika ada)
        if (!empty($schedule->modul_praktikum) && Storage::disk('public')->exists($schedule->modul_praktikum)) {
            Storage::disk('public')->delete($schedule->modul_praktikum);
            $modulFolder = dirname($schedule->modul_praktikum); // hapus folder tempat modul
            $this->deleteFolderIfExists($modulFolder);
        }

        // hapus jadwal
        $schedule->delete();

        return redirect()->route('scheduling.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Generate folder path dokumentasi.
     */
    private function generateDocumentationFolder(Schedulings $schedule): string
    {
        return 'documentations/' . $schedule->id;
    }

    /**
     * Hapus folder jika ada.
     */
    private function deleteFolderIfExists(string $folderPath): void
    {
        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }
    }
}
