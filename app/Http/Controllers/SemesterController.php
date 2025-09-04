<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
    // Ambil semester aktif
    public function active()
    {
        $active = Semester::active()->first();

        if (!$active) {
            return response()->json(['message' => 'Tidak ada semester aktif']);
        }

        return response()->json($active);
    }

    // Ambil semua semester di tahun ajar tertentu (misal 2025/2026)
    public function byYear($year)
    {
        $semesters = Semester::where('name', 'like', "%$year%")->get();

        return response()->json($semesters);
    }
}
