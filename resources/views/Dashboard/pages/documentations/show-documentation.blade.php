@extends('dashboard.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">
                <i class="fa fa-info-circle"></i> Detail Dokumentasi Praktikum
            </h5>
        </div>

        <div class="card-body p-4" style="font-size: 16px;">
            <!-- Informasi Jadwal -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>👨‍🏫 Nama Dosen:</strong><br>
                    <span class="text-dark">{{ $scheduling->nama_dosen }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>📚 Mata Kuliah:</strong><br>
                    <span class="text-dark">{{ $scheduling->mata_kuliah }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>🏫 Kelas:</strong><br>
                    <span class="text-dark">{{ $scheduling->kelas }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>📅 Tanggal Praktikum:</strong><br>
                    <span class="text-dark">{{ \Carbon\Carbon::parse($scheduling->tanggal_praktikum)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>⏰ Waktu Praktikum:</strong><br>
                    <span class="text-dark">{{ $scheduling->waktu_praktikum }}</span>
                </div>
                <div class="col-md-12 mb-3">
                    <strong>🛠️ Tools / Software yang Digunakan:</strong><br>
                    <span class="text-dark">{{ $scheduling->tools_software }}</span>
                </div>
            </div>

            <hr>

            <!-- Dokumentasi -->
            <h5 class="fw-semibold text-dark mb-3">📸 Dokumentasi Praktikum</h5>

            @if ($documentation)
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>📄 Nama Dokumentasi:</strong><br>
                        <span class="text-dark">{{ $documentation->nama }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>🗓️ Tanggal Upload:</strong><br>
                        <span class="text-dark">{{ \Carbon\Carbon::parse($documentation->tanggal_upload)->format('d M Y H:i') }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>📝 Absen 1:</strong><br>
                        @if ($documentation->absen_1)
                            <a href="{{ asset('storage/' . $documentation->absen_1) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                <i class="fa fa-file-text-o"></i> Lihat Absen 1
                            </a>
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>📝 Absen 2:</strong><br>
                        @if ($documentation->absen_2)
                            <a href="{{ asset('storage/' . $documentation->absen_2) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                <i class="fa fa-file-text-o"></i> Lihat Absen 2
                            </a>
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>🖼️ Foto 1:</strong><br>
                        @if ($documentation->foto_1)
                            <img src="{{ asset('storage/' . $documentation->foto_1) }}" class="img-fluid rounded shadow-sm mt-2" style="max-height: 200px;" alt="Foto 1">
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>🖼️ Foto 2:</strong><br>
                        @if ($documentation->foto_2)
                            <img src="{{ asset('storage/' . $documentation->foto_2) }}" class="img-fluid rounded shadow-sm mt-2" style="max-height: 200px;" alt="Foto 2">
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </div>
                </div>
            @else
                <div class="alert alert-warning mt-3">Dokumentasi belum diunggah untuk jadwal ini.</div>
            @endif

            <hr>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('documentation.index') }}" class="btn btn-light border rounded-pill">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('documentations.edit', $documentation->id) }}" class="btn btn-warning rounded-pill me-2">
                    <i class="fa fa-pencil"></i> Edit Dokumentasi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
