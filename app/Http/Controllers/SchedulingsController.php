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

    public function show($id)
    {
        $schedule = Schedulings::findOrFail($id);
        return view('dashboard.pages.schedulings.show-scheduling', compact('schedule'));
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

        // Cek jadwal bentrok
        $bentrok = Schedulings::where('tanggal_praktikum', $request->tanggal_praktikum)
            ->where('waktu_praktikum', $request->waktu_praktikum)
            ->exists();

        if ($bentrok) {
            return back()->withErrors([
                'tanggal_praktikum' => 'Jadwal sudah digunakan pada waktu tersebut.'
            ])->withInput();
        }

        // Simpan file modul
        $modulPath = $request->file('modul_praktikum')->store('modul_praktikum', 'public');

        // Simpan ke DB
        Schedulings::create([
            'nama_dosen'        => $request->nama_dosen,
            'kelas'             => $request->kelas,
            'mata_kuliah'       => $request->mata_kuliah,
            'tanggal_praktikum' => $request->tanggal_praktikum,
            'waktu_praktikum'   => $request->waktu_praktikum,
            'modul_praktikum'   => $modulPath,
            'tools_software'    => $request->tools_software,
        ]);

        return redirect()->route('schedulings.create')->with('success', 'Jadwal berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $schedule = Schedulings::findOrFail($id);
        return view('dashboard.pages.schedulings.update-scheduling', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'mata_kuliah' => 'required|string',
            'tanggal_praktikum' => 'required|date',
            'waktu_praktikum' => 'required|string',
            'tools_software' => 'required|string',
        ]);

        // Cek duplikasi tanggal + waktu
        $conflict = Schedulings::where('tanggal_praktikum', $request->tanggal_praktikum)
            ->where('waktu_praktikum', $request->waktu_praktikum)
            ->where('id', '!=', $id)
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['tanggal_praktikum' => 'Tanggal dan waktu praktikum sudah terpakai.'])->withInput();
        }

        $schedule = Schedulings::findOrFail($id);
        $schedule->update($request->except('modul_praktikum'));

        // File handling
        if ($request->hasFile('modul_praktikum')) {
            $file = $request->file('modul_praktikum')->store('moduls', 'public');
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
