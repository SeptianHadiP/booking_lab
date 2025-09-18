<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\CertificateTemplate;

class TemplateController extends Controller
{
    /**
     * Generate dan simpan file template ke folder public/templates
     */
    private function generateFilePath($file, $templateName = null): ?string
    {
        if (!$file) {
            return null;
        }

        // Gunakan nama template jika ada, kalau tidak pakai timestamp
        $folderName = $templateName ? Str::slug($templateName) : time();

        // Buat folder jika belum ada
        $pathFolder = public_path("assets/templates-sertifikat/{$folderName}");
        if (!is_dir($pathFolder)) {
            mkdir($pathFolder, 0755, true);
        }

        // Buat nama file unik: timestamp + nama asli yang di-slug
        $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                  . '.' . $file->getClientOriginalExtension();

        // Pindahkan file ke folder yang sudah dibuat
        $file->move($pathFolder, $fileName);

        // Return path relatif untuk disimpan di database
        return "assets/templates-sertifikat/{$folderName}/{$fileName}";
    }

    public function index()
    {
        $templates = CertificateTemplate::latest()->get();
        return view('dashboard.pages.template.index', compact('templates'));
    }

    public function templateForm()
    {
        return view('dashboard.pages.template.create-template');
    }

    public function storeTemplate(Request $request)
    {
        Log::info('Mulai menyimpan template ke database', $request->all());

        try {
            $filePath = $request->hasFile('template_file')
                ? $this->generateFilePath($request->file('template_file'), $request->name)
                : null;

            $template = CertificateTemplate::create([
                'name'          => $request->name ?? 'Template ' . now()->format('Ymd_His'),
                'file_path'     => $filePath,
                'font_color'    => $request->font_color,
                'name_x_type'   => $request->name_x_type,
                'name_x'        => $request->name_x,
                'name_y_type'   => $request->name_y_type,
                'name_y'        => $request->name_y,
                'score_x_type'  => $request->score_x_type,
                'score_x'       => $request->score_x,
                'score_y_type'  => $request->score_y_type,
                'score_y'       => $request->score_y,
                'desc_x_type'   => $request->desc_x_type,
                'desc_x'        => $request->desc_x,
                'desc_y_type'   => $request->desc_y_type,
                'desc_y'        => $request->desc_y,
            ]);

            Log::info('Berhasil menyimpan template ke database', ['template_id' => $template->id]);
            return redirect()->route('template.index')->with('success', 'Template berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Gagal update template: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal update template!');
        }
    }

    public function edit($id)
    {
        $template = CertificateTemplate::findOrFail($id);
        return view('dashboard.pages.template.update-template', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $template = CertificateTemplate::findOrFail($id);

        try {
            $filePath = $template->file_path; // default pakai file lama

            if ($request->hasFile('template_file')) {
                // Hapus file lama jika ada
                if ($template->file_path && file_exists(public_path($template->file_path))) {
                    unlink(public_path($template->file_path));
                }

                // Simpan file baru
                $filePath = $this->generateFilePath($request->file('template_file'), $request->name ?? $template->name);
            }

            $template->update([
                'name'          => $request->name ?? $template->name,
                'file_path'     => $filePath,
                'font_color'    => $request->font_color,
                'name_x_type'   => $request->name_x_type,
                'name_x'        => $request->name_x,
                'name_y_type'   => $request->name_y_type,
                'name_y'        => $request->name_y,
                'score_x_type'  => $request->score_x_type,
                'score_x'       => $request->score_x,
                'score_y_type'  => $request->score_y_type,
                'score_y'       => $request->score_y,
                'desc_x_type'   => $request->desc_x_type,
                'desc_x'        => $request->desc_x,
                'desc_y_type'   => $request->desc_y_type,
                'desc_y'        => $request->desc_y,
            ]);

            return redirect()->route('template.index')->with('success', 'Template berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Gagal update template: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal update template!');
        }
    }

    public function destroy($id)
    {
        try {
            $template = CertificateTemplate::findOrFail($id);

            if ($template->file_path) {
                $fullPath = public_path($template->file_path);

                // Hapus file jika ada
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }

                // Hapus folder jika kosong
                $folderPath = dirname($fullPath);
                if (is_dir($folderPath)) {
                    // Periksa apakah folder kosong
                    $files = array_diff(scandir($folderPath), ['.', '..']);
                    if (empty($files)) {
                        rmdir($folderPath);
                    }
                }
            }

            $template->delete();

            return redirect()->route('template.index')->with('success', 'Template berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus template: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus template!');
        }
    }
}
