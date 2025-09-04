<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedulings;
use App\Models\Kelas;
use App\Models\Laboratorium;
use App\Models\MataKuliahPraktikum;
use App\Models\Semester;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SchedulingsController extends Controller
{
    public function index()
    {
        $schedules = Schedulings::with(['mata_kuliah_praktikum', 'kelas', 'laboratorium', 'user'])
            ->latest()
            ->get();

        return view('dashboard.pages.schedulings.index', compact('schedules'));
    }

    public function show($id)
    {
        // $schedule = Schedulings::with('user')->findOrFail($id);
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

        // Ambil semester aktif berdasarkan tanggal booking
        // $semester = Semester::where('start_date', '<=', $request->tanggal_praktikum)
        //                     ->where('end_date', '>=', $request->tanggal_praktikum)
        //                     ->first();

        // if (!$semester) {
        //     return back()->withErrors([
        //         'tanggal_praktikum' => 'Tanggal yang dipilih tidak termasuk dalam semester aktif.'
        //     ])->withInput();
        // }

        // Cek bentrok jadwal
        $bentrok = Schedulings::where('tanggal_praktikum', $request->tanggal_praktikum)
            ->where('waktu_praktikum', $request->waktu_praktikum)
            ->where('lab_id', $request->lab_id)
            ->exists();

        if ($bentrok) {
            return back()->withErrors([
                'tanggal_praktikum' => 'Jadwal sudah digunakan pada waktu tersebut.'
            ])->withInput();
        }

        // Upload modul
        $modulPath = $request->file('modul_praktikum')->store('modul_praktikum', 'public');

        Schedulings::create([
            'user_id'           => Auth::id(),
            'kelas_id'          => $request->kelas_id,
            'mata_kuliah_id'    => $request->mata_kuliah_id,
            'lab_id'            => $request->lab_id,
            // 'semester_id'       => $semester->code, // simpan semester aktif
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

        // Cek bentrok jadwal
        $conflict = Schedulings::where('tanggal_praktikum', $request->tanggal_praktikum)
            ->where('waktu_praktikum', $request->waktu_praktikum)
            ->where('lab_id', $request->lab_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['tanggal_praktikum' => 'Tanggal dan waktu praktikum sudah terpakai.'])->withInput();
        }

        $schedule = Schedulings::findOrFail($id);

        $schedule->update([
            'user_id'           => Auth::id(),
            'kelas_id'          => $request->kelas_id,
            'mata_kuliah_id'    => $request->mata_kuliah_id,
            'lab_id'            => $request->lab_id,
            'tanggal_praktikum' => $request->tanggal_praktikum,
            'waktu_praktikum'   => $request->waktu_praktikum,
            'judul_praktikum'   => $request->judul_praktikum,
            'deskripsi'         => $request->deskripsi,
        ]);

        // File handling
        if ($request->hasFile('modul_praktikum')) {
            // Hapus file lama
            if ($schedule->modul_praktikum && Storage::disk('public')->exists($schedule->modul_praktikum)) {
                Storage::disk('public')->delete($schedule->modul_praktikum);
            }

            $file = $request->file('modul_praktikum')->store('modul_praktikum', 'public');
            $schedule->modul_praktikum = $file;
            $schedule->save();
        }

        return redirect()->route('schedulings.edit', $id)->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $schedule = Schedulings::findOrFail($id);

        // Jika ada file modul, hapus juga
        if ($schedule->modul_praktikum && Storage::disk('public')->exists($schedule->modul_praktikum)) {
            Storage::disk('public')->delete($schedule->modul_praktikum);
        }

        $schedule->delete();

        return redirect()->route('scheduling.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
