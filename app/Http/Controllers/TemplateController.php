<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\CertificateTemplate;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = CertificateTemplate::latest()->get();
        return view('dashboard.pages.template.index', compact('templates'));
    }

    public function templateForm()
    {
        return view('dashboard/pages/template/create-template');
    }

    public function storeTemplate(Request $request)
    {
        Log::info('Mulai menyimpan template ke database', $request->all());

        try {
            $templateFileName = null;

            // Simpan file template background (ke public/templates)
            if ($request->hasFile('template_file')) {
                $templateFile = $request->file('template_file');
                $templateFileName = time() . '_' . Str::slug(pathinfo($templateFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $templateFile->getClientOriginalExtension();
                $templateFile->move(public_path('templates'), $templateFileName);
            }

            // Simpan ke database
            $template = CertificateTemplate::create([
                'name'          => $request->name ?? 'Template ' . now()->format('Ymd_His'),
                'file_path'     => $templateFileName ? 'templates/' . $templateFileName : null,
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
            return redirect()->back()->with('success', 'Template berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan template ke database: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan template!');
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
            $templateFileName = $template->file_path; // default: pakai file lama

            // Jika user upload file baru
            if ($request->hasFile('template_file')) {
                // Hapus file lama kalau ada
                if ($template->file_path && file_exists(public_path($template->file_path))) {
                    unlink(public_path($template->file_path));
                }

                // Simpan file baru
                $templateFile = $request->file('template_file');
                $templateFileName = 'templates/' . time() . '_' . Str::slug(pathinfo($templateFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $templateFile->getClientOriginalExtension();
                $templateFile->move(public_path('templates'), basename($templateFileName));
            }

            // Update data
            $template->update([
                'name'          => $request->name ?? $template->name,
                'file_path'     => $templateFileName,
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

            // Hapus file fisik jika ada
            if ($template->file_path && file_exists(public_path($template->file_path))) {
                unlink(public_path($template->file_path));
            }

            $template->delete();

            return redirect()->route('template.index')->with('success', 'Template berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus template: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus template!');
        }
    }

}
