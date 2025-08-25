<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use App\Models\Schedulings;
use App\Models\Kelas;
use App\Models\Laboratorium;
use App\Models\MataKuliahPraktikum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    public function index()
    {
        $schedules = Schedulings::with(['mata_kuliah_praktikum', 'kelas', 'laboratorium'])->latest()->get();
        return view('dashboard.pages.documentations.index', compact('schedules'));
    }

    public function create($scheduling_id)
    {
        $kelasList = Kelas::all();
        $mataKuliahList = MataKuliahPraktikum::all();
        $labList = Laboratorium::all();
        $scheduling = Schedulings::findOrFail($scheduling_id);
        return view('dashboard.pages.documentations.create-documentation', compact('scheduling'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'scheduling_id' => 'required|exists:schedulings,id',
            'nama' => 'required|string|max:255',
            'foto_1' => 'required|image|max:2048',
            'foto_2' => 'required|image|max:2048',
            'absen_1' => 'nullable|image|max:2048',
            'absen_2' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['scheduling_id', 'nama']);

        // Simpan ke folder terpisah berdasarkan jenis
        $data['foto_1'] = $request->file('foto_1')->store('images/documentation/kegiatan', 'public');
        $data['foto_2'] = $request->file('foto_2')->store('images/documentation/kegiatan', 'public');
        $data['absen_1'] = $request->file('absen_1')?->store('images/documentation/absensi', 'public');
        $data['absen_2'] = $request->file('absen_2')?->store('images/documentation/absensi', 'public');

        Documentation::create($data);

        return redirect()
            ->route('documentations.create', $request->scheduling_id)
            ->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $documentation = Documentation::with('schedule')->findOrFail($id);
        $scheduling = $documentation->schedule;

        return view('dashboard.pages.documentations.show-documentation', compact('scheduling', 'documentation'));
    }

    public function edit($id)
    {
        $documentation = Documentation::findOrFail($id);
        return view('dashboard.pages.documentations.update-documentation', compact('documentation'));
    }

    public function update(Request $request, $id)
    {
        $documentation = Documentation::findOrFail($id);

        $request->validate([
            'foto_1' => 'nullable|image|max:2048',
            'foto_2' => 'nullable|image|max:2048',
            'absen_1' => 'nullable|image|max:2048',
            'absen_2' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);

        // Simpan ulang hanya jika ada file baru di-upload
        foreach (['foto_1', 'foto_2'] as $field) {
            if ($request->hasFile($field)) {
                if ($documentation->$field && Storage::disk('public')->exists($documentation->$field)) {
                    Storage::disk('public')->delete($documentation->$field);
                }
                $data[$field] = $request->file($field)->store('images/documentation/kegiatan', 'public');
            }
        }

        foreach (['absen_1', 'absen_2'] as $field) {
            if ($request->hasFile($field)) {
                if ($documentation->$field && Storage::disk('public')->exists($documentation->$field)) {
                    Storage::disk('public')->delete($documentation->$field);
                }
                $data[$field] = $request->file($field)->store('images/documentation/absensi', 'public');
            }
        }

        $documentation->update($data);

        return redirect()
            ->route('documentation.index')
            ->with('success', 'Dokumentasi berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $documentation = Documentation::findOrFail($id);

        foreach (['foto_1', 'foto_2', 'absen_1', 'absen_2'] as $field) {
            if ($documentation->$field && Storage::disk('public')->exists($documentation->$field)) {
                Storage::disk('public')->delete($documentation->$field);
            }
        }

        $documentation->delete();
        return redirect()->route('documentation.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
