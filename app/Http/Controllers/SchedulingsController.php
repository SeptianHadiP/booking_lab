<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedulings;
use Illuminate\Support\Facades\Storage;

class SchedulingsController extends Controller
{
    public function index()
    {
        $schedules = Schedulings::latest()->get();
        return view('dashboard.pages.schedulings.index', compact('schedules'));
    }

    public function create()
    {
        return view('dashboard.pages.schedulings.create-scheduling');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dosen'        => 'required|string|max:255',
            'kelas'             => 'required|string|max:20',
            'mata_kuliah'       => 'required|string',
            'tanggal_praktikum' => 'required|date',
            'waktu_praktikum'   => 'required|string',
            'modul_praktikum'   => 'required|mimes:pdf,doc,docx|max:2048',
            'tools_software'    => 'required|string',
        ]);

        // Validasi manual jadwal bentrok (lapisan pertama)
        $bentrok = Schedulings::where('tanggal_praktikum', $request->tanggal_praktikum)
            ->where('waktu_praktikum', $request->waktu_praktikum)
            ->exists();

        if ($bentrok) {
            return back()->withErrors([
                'tanggal_praktikum' => 'Jadwal sudah digunakan pada waktu tersebut.'
            ])->withInput();
        }

        try {
            // Simpan file modul
            $modulPath = $request->file('modul_praktikum')->store('modul_praktikum', 'public');

            // Simpan ke database
            Schedulings::create([
                'nama_dosen'        => $request->nama_dosen,
                'kelas'             => $request->kelas,
                'mata_kuliah'       => $request->mata_kuliah,
                'tanggal_praktikum' => $request->tanggal_praktikum,
                'waktu_praktikum'   => $request->waktu_praktikum,
                'modul_praktikum'   => $modulPath,
                'tools_software'    => $request->tools_software,
            ]);

            return redirect()->route('schedulings.index')->with('success', 'Jadwal berhasil ditambahkan.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi duplikasi dari sisi database (backup)
            return back()->withErrors([
                'tanggal_praktikum' => 'Jadwal ini sudah digunakan. Silakan pilih tanggal dan waktu lain.'
            ])->withInput();
        }
    }

    public function update($id)
    {
        $schedule = Schedulings::findOrFail($id);
        return view('dashboard.pages.schedulings.update-scheduling', compact('schedule'));
    }

    public function destroy($id)
    {
        $schedule = Schedulings::findOrFail($id);

        // Jika ada file modul, hapus juga
        if ($schedule->modul_praktikum && Storage::disk('public')->exists($schedule->modul_praktikum)) {
            Storage::disk('public')->delete($schedule->modul_praktikum);
        }

        $schedule->delete();

        return redirect()->route('schedulings.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
