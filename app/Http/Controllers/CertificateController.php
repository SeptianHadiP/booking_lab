<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CertificateTemplate;

class CertificateController extends Controller
{
    public function form()
    {
        $templates = CertificateTemplate::all();
        return view('dashboard/pages/certificates/create-certificate', compact('templates'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'spreadsheet' => 'required|file|mimes:xlsx,xls,csv',
            'template_id' => 'required|exists:certificate_templates,id',
        ]);

        $template = CertificateTemplate::findOrFail($request->template_id);
        $spreadsheet = $request->file('spreadsheet');
        $rows = Excel::toArray([], $spreadsheet)[0];

        // Background image base64
        $bgImagePath = public_path($template->file_path);
        if (!file_exists($bgImagePath)) {
            abort(500, 'Background template not found: ' . $bgImagePath);
        }
        $bgImageBase64 = 'data:' . mime_content_type($bgImagePath) . ';base64,' . base64_encode(file_get_contents($bgImagePath));

        $options = [
            'isRemoteEnabled'      => true,
            'isHtml5ParserEnabled' => true,
            'chroot'               => public_path(),
        ];

        $generatedCertificates = [];

        foreach ($rows as $index => $row) {
            if ($index < 6) continue;

            $name = trim($row[2] ?? '');
            $score = trim($row[3] ?? '');
            $course = trim($rows[2][2] ?? 'Telah Mengikuti');

            if (!$name) continue;

            $viewData = [
                'name'        => $name,
                'score'       => $score,
                'course'      => $course,
                'nameXType'   => $template->name_x_type,
                'nameX'       => $template->name_x,
                'nameYType'   => $template->name_y_type,
                'nameY'       => $template->name_y,
                'scoreXType'  => $template->score_x_type,
                'scoreX'      => $template->score_x,
                'scoreYType'  => $template->score_y_type,
                'scoreY'      => $template->score_y,
                'descXType'   => $template->desc_x_type,
                'descX'       => $template->desc_x,
                'descYType'   => $template->desc_y_type,
                'descY'       => $template->desc_y,
                'bgImage'     => $bgImageBase64,
                'template'    => $template,
                'fontColor'   => $template->font_color ?? '#000000',
            ];


            $pdf = Pdf::setOptions($options)
                ->loadView('dashboard/pages/certificates/pdf-certificate', $viewData)
                ->setPaper('a4', 'landscape');

            $filename = Str::slug($name) . '_' . now()->format('Ymd-His') . '.pdf';
            Storage::disk('public')->put('generated_certificates/' . $filename, $pdf->output());

            $generatedCertificates[] = $filename;
        }

        return view('dashboard/pages/certificates/result-certificate', compact('generatedCertificates'));
    }
}
