<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use App\Models\Schedulings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentationController extends Controller
{
    private function generateDocumentationPath($scheduling): string
    {
        // rapikan tahun ajar, ganti "/" jadi "-"
        $tahunAjar = Str::slug(str_replace('/', '-', $scheduling->semester->tahun_ajar ?? date('Y')));
        $lab       = Str::slug($scheduling->laboratorium->nama_ruangan ?? 'Lab');
        $kelas     = Str::slug($scheduling->kelas->nama_kelas ?? 'Kelas');

        // ambil teks dalam tanda kurung "(Sesi X)"
        preg_match('/\((.*?)\)/', $scheduling->waktu_praktikum, $matches);
        $sesi = isset($matches[1]) ? Str::slug($matches[1]) : Str::slug($scheduling->waktu_praktikum);

        return "assets/dokumentasi/{$tahunAjar}/{$lab}/{$kelas}/{$sesi}";
    }

    public function index()
    {
        $schedules = Schedulings::with(['mata_kuliah_praktikum', 'kelas', 'laboratorium'])->latest()->get();
        return view('dashboard.pages.documentations.index', compact('schedules'));
    }

    public function create($scheduling_id)
    {
        $scheduling = Schedulings::with(['user', 'mata_kuliah_praktikum', 'kelas', 'laboratorium'])
            ->findOrFail($scheduling_id);

        return view('dashboard.pages.documentations.create-documentation', compact('scheduling'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'scheduling_id' => 'required|exists:schedulings,id',
            'nama'   => 'required|string|max:255',
            'foto_1' => 'required|image|max:2048',
            'foto_2' => 'nullable|image|max:2048',
            'absen_1'=> 'required|image|max:2048',
            'absen_2'=> 'nullable|image|max:2048',
        ]);

        $scheduling = Schedulings::with(['kelas', 'laboratorium', 'semester'])
            ->findOrFail($request->scheduling_id);

        $basePath = $this->generateDocumentationPath($scheduling);

        $data = $request->only(['scheduling_id', 'nama']);
        $data['foto_1']  = $request->file('foto_1')->store("{$basePath}/kegiatan", 'public');
        $data['foto_2']  = $request->file('foto_2') ? $request->file('foto_2')->store("{$basePath}/kegiatan", 'public') : null;
        $data['absen_1'] = $request->file('absen_1')->store("{$basePath}/absensi", 'public');
        $data['absen_2'] = $request->file('absen_2') ? $request->file('absen_2')->store("{$basePath}/absensi", 'public') : null;

        Documentation::create($data);

        return redirect()
            ->route('scheduling.index', $request->scheduling_id)
            ->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $documentation = Documentation::with([
            'scheduling.user',
            'scheduling.mata_kuliah_praktikum',
            'scheduling.kelas',
            'scheduling.laboratorium'
        ])->findOrFail($id);

        $scheduling = $documentation->scheduling;

        return view('dashboard.pages.documentations.show-documentation', compact('scheduling', 'documentation'));
    }

    public function edit($id)
    {
        $documentation = Documentation::with([
            'scheduling.user',
            'scheduling.mata_kuliah_praktikum',
            'scheduling.kelas',
            'scheduling.laboratorium'
        ])->findOrFail($id);

        // ambil scheduling dari relasi documentation
        $scheduling = $documentation->scheduling;

        return view('dashboard.pages.documentations.update-documentation', compact('documentation', 'scheduling'));
    }

    public function update(Request $request, $id)
    {
        $documentation = Documentation::with(['scheduling.kelas', 'scheduling.laboratorium', 'scheduling.semester'])
            ->findOrFail($id);

        $request->validate([
            'foto_1'  => 'nullable|image|max:2048',
            'foto_2'  => 'nullable|image|max:2048',
            'absen_1' => 'nullable|image|max:2048',
            'absen_2' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);

        $basePath = $this->generateDocumentationPath($documentation->scheduling);

        foreach (['foto_1', 'foto_2'] as $field) {
            if ($request->hasFile($field)) {
                if ($documentation->$field && Storage::disk('public')->exists($documentation->$field)) {
                    Storage::disk('public')->delete($documentation->$field);
                }
                $data[$field] = $request->file($field)->store("{$basePath}/kegiatan", 'public');
            }
        }

        foreach (['absen_1', 'absen_2'] as $field) {
            if ($request->hasFile($field)) {
                if ($documentation->$field && Storage::disk('public')->exists($documentation->$field)) {
                    Storage::disk('public')->delete($documentation->$field);
                }
                $data[$field] = $request->file($field)->store("{$basePath}/absensi", 'public');
            }
        }

        $documentation->update($data);

        return redirect()
            ->route('scheduling.index')
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
        return redirect()->route('scheduling.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
