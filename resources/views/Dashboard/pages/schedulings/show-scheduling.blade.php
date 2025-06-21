@extends('dashboard.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">
                <i class="fa fa-info-circle"></i> Informasi Jadwal Praktikum
            </h5>
        </div>

        <div class="card-body p-4" style="font-size: 16px;">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>👨‍🏫 Nama Dosen:</strong><br>
                    <span class="text-dark">{{ $schedule->nama_dosen }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>📚 Mata Kuliah:</strong><br>
                    <span class="text-dark">{{ $schedule->mata_kuliah }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>🏫 Kelas:</strong><br>
                    <span class="text-dark">{{ $schedule->kelas }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>📅 Tanggal Praktikum:</strong><br>
                    <span class="text-dark">{{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>⏰ Waktu Praktikum:</strong><br>
                    <span class="text-dark">{{ $schedule->waktu_praktikum }}</span>
                </div>
                <div class="col-md-12 mb-3">
                    <strong>🛠️ Tools / Software yang Digunakan:</strong><br>
                    <span class="text-dark">{{ $schedule->tools_software }}</span>
                </div>
                <div class="col-md-12 mb-3">
                    <strong>📄 Modul Praktikum:</strong><br>
                    @if ($schedule->modul_praktikum)
                        <a href="{{ asset('storage/' . $schedule->modul_praktikum) }}" target="_blank" class="btn btn-outline-primary btn-sm mt-1">
                            <i class="fa fa-file-pdf-o"></i> Lihat Modul
                        </a>
                    @else
                        <span class="text-muted">Belum ada modul yang diunggah</span>
                    @endif
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('scheduling.index') }}" class="btn btn-light border rounded-pill">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('schedulings.edit', $schedule->id) }}" class="btn btn-warning text-white rounded-pill">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <form action="{{ route('schedulings.destroy', $schedule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
