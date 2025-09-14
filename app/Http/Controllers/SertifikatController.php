<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CertificateTemplate;
use App\Models\Sertifikat;
use App\Models\LaporanPraktikum;

class SertifikatController extends Controller
{
    /**
     * Menampilkan form generate sertifikat
     */
    public function create($laprakId)
    {
        $laprak = LaporanPraktikum::with(['user', 'mata_kuliah_praktikum', 'kelas', 'semester'])
                    ->whereNotNull('nilai_file')
                    ->findOrFail($laprakId);

        $templates = CertificateTemplate::all();

        return view('dashboard.pages.certificates.create-certificate', compact('laprak', 'templates'));
    }

    /**
     * Menyimpan sertifikat dan generate PDF
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'laprak_id'   => 'required|exists:laporan_praktikum,id',
            'template_id' => 'required|exists:certificate_templates,id',
        ]);

        $template = CertificateTemplate::findOrFail($validated['template_id']);
        $laprak   = LaporanPraktikum::with(['user','mata_kuliah_praktikum','kelas','semester'])
                    ->findOrFail($validated['laprak_id']);

        // Load file excel nilai
        $excelPath = storage_path('app/public/' . $laprak->nilai_file);
        if (!file_exists($excelPath)) {
            return back()->with('error', 'File nilai tidak ditemukan.');
        }
        $rows = Excel::toArray([], $excelPath)[0];

        // Background image base64
        $bgImagePath = public_path($template->file_path);
        if (!file_exists($bgImagePath)) {
            return back()->with('error', 'Background template tidak ditemukan.');
        }
        $bgImageBase64 = 'data:' . mime_content_type($bgImagePath) . ';base64,' . base64_encode(file_get_contents($bgImagePath));

        $options = [
            'isRemoteEnabled'      => true,
            'isHtml5ParserEnabled' => true,
            'chroot'               => public_path(),
        ];

        $generatedCertificates = [];

        // Ambil data untuk folder
        $tahunAjaran  = Str::slug($laprak->semester->tahun_ajar ?? date('Y'));
        $mataKuliah   = Str::slug($laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? 'mata-kuliah');
        $kelas        = Str::slug($laprak->kelas->nama_kelas ?? 'kelas');

        // Susunan folder
        $basePath = "generated_certificates/{$tahunAjaran}/{$mataKuliah}/{$kelas}";

        foreach ($rows as $index => $row) {
            if ($index < 6) continue;

            $name   = trim($row[2] ?? '');
            $score  = trim($row[3] ?? '');
            $course = trim($rows[2][2] ?? 'Telah Mengikuti');

            if (!$name) continue;

            $viewData = [
                'name'      => $name,
                'score'     => $score,
                'course'    => $course,
                'bgImage'   => $bgImageBase64,
                'template'  => $template,
                'fontColor' => $template->font_color ?? '#000000',
                'nameX'     => $template->name_x,
                'nameY'     => $template->name_y,
                'nameXType' => $template->name_x_type,
                'nameYType' => $template->name_y_type,
                'scoreX'    => $template->score_x,
                'scoreY'    => $template->score_y,
                'scoreXType'=> $template->score_x_type,
                'scoreYType'=> $template->score_y_type,
                'descX'     => $template->desc_x,
                'descY'     => $template->desc_y,
                'descXType' => $template->desc_x_type,
                'descYType' => $template->desc_y_type,
            ];

            $pdf = Pdf::setOptions($options)
                ->loadView('dashboard.pages.certificates.pdf-certificate', $viewData)
                ->setPaper('a4', 'landscape');

            // Nama file -> nama_mahasiswa + timestamp
            $filename = Str::slug($name) . '_' . now()->format('Ymd-His') . '.pdf';

            // Simpan ke folder yang rapi
            Storage::disk('public')->put("{$basePath}/{$filename}", $pdf->output());

            $generatedCertificates[] = "{$basePath}/{$filename}";
        }

        return view('dashboard.pages.certificates.result-certificate', [
            'files'    => $generatedCertificates,
            'laprakId' => $laprak->id,
        ])->with('success', 'Sertifikat berhasil dibuat.');
    }




    /**
     * Menampilkan hasil sertifikat yang baru dibuat
     */
    public function result()
    {
        $files = session('generatedCertificates', []);
        $laprakId = session('laprakId');

        if (!$laprakId) {
            // Redirect ke daftar laporan praktikum jika tidak ada laprakId
            return redirect()->route('laprak.index')->with('error', 'Tidak ada data laporan praktikum untuk generate sertifikat.');
        }

        return view('dashboard.pages.certificates.result-certificate', compact('files', 'laprakId'));
    }

}
