@extends('dashboard.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">
                <i class="fa fa-info-circle"></i> Detail Jadwal & Dokumentasi Praktikum
            </h5>
        </div>

        <div class="card-body p-4" style="font-size: 16px;">
            <!-- Informasi Jadwal -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>👨‍🏫 Nama Dosen:</strong><br>
                    <span class="text-dark">{{ $scheduling->user->name ?? 'Dosen tidak ditemukan' }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>📚 Mata Kuliah:</strong><br>
                    <span class="text-dark">{{ $scheduling->mata_kuliah_praktikum->nama_mata_kuliah ?? 'Mata kuliah tidak ditemukan' }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>🏫 Kelas:</strong><br>
                    <span class="text-dark">{{ $scheduling->kelas->nama_kelas ?? 'Kelas tidak ditemukan' }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>🏢 Tempat / Lab Praktikum:</strong><br>
                    <span class="text-dark">{{ $scheduling->laboratorium->nama_ruangan ?? 'Laboratorium tidak ditemukan' }}</span>
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
                    <span class="text-dark">{{ $scheduling->deskripsi }}</span>
                </div>
            </div>

            <hr>

            {{-- Dokumentasi Praktikum --}}
                <div class="col-md-12 mb-4">
                    <strong>📸 Dokumentasi Praktikum:</strong>
                    <div class="mt-2 p-3 border rounded-3 bg-light">
                        @if ($scheduling->documentation)
                            <div class="mb-2 d-flex justify-content-between">
                                <div>
                                    <span class="fw-bold">Buat oleh:</span>
                                    <span class="text-dark">{{ $scheduling->documentation->nama ?? '-' }}</span>
                                </div>
                                <div>
                                    <span class="text-dark">
                                        {{ $scheduling->documentation->created_at->format('d M Y (H:i)') }}
                                    </span>
                                </div>
                            </div>

                            <div class="row g-3">
                                {{-- Foto 1 --}}
                                <div class="col-md-6 text-center">
                                    <div class="border rounded p-2 bg-white shadow-sm h-100">
                                        <strong>Foto 1</strong>
                                        @if ($scheduling->documentation->foto_1)<br>
                                            <img src="{{ asset('storage/' . $scheduling->documentation->foto_1) }}"
                                                alt="Foto 1"
                                                class="img-fluid rounded mt-2 popup-img"
                                                data-img="{{ asset('storage/' . $scheduling->documentation->foto_1) }}"
                                                style="max-height: 250px; object-fit: cover; cursor:pointer;">
                                        @else
                                            <p class="text-muted mt-2">Tidak ada foto</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Foto 2 --}}
                                <div class="col-md-6 text-center">
                                    <div class="border rounded p-2 bg-white shadow-sm h-100">
                                        <strong>Foto 2</strong>
                                        @if ($scheduling->documentation->foto_2)<br>
                                            <img src="{{ asset('storage/' . $scheduling->documentation->foto_2) }}"
                                                alt="Foto 2"
                                                class="img-fluid rounded mt-2 popup-img"
                                                data-img="{{ asset('storage/' . $scheduling->documentation->foto_2) }}"
                                                style="max-height: 250px; object-fit: cover; cursor:pointer;">
                                        @else
                                            <p class="text-muted mt-2">Tidak ada foto</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="row g-3">
                                    {{-- Absen 1 --}}
                                    <div class="col-md-6 text-center">
                                        <div class="border rounded p-2 bg-white shadow-sm h-100">
                                            <strong>Foto Absen 1</strong><br>
                                            @if ($scheduling->documentation->absen_1)
                                                <img src="{{ Storage::url($scheduling->documentation->absen_1) }}"
                                                    alt="Absen 1"
                                                    class="img-fluid rounded mt-2 popup-img"
                                                    data-img="{{ Storage::url($scheduling->documentation->absen_1) }}"
                                                    style="max-height: 250px; object-fit: cover; cursor:pointer;">
                                            @else
                                                <p class="text-muted mt-2">Tidak ada foto absen</p>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Absen 2 --}}
                                    <div class="col-md-6 text-center">
                                        <div class="border rounded p-2 bg-white shadow-sm h-100">
                                            <strong>Foto Absen 2</strong><br>
                                            @if ($scheduling->documentation->absen_2)
                                                <img src="{{ Storage::url($scheduling->documentation->absen_2) }}"
                                                    alt="Absen 2"
                                                    class="img-fluid rounded mt-2 popup-img"
                                                    data-img="{{ Storage::url($scheduling->documentation->absen_2) }}"
                                                    style="max-height: 250px; object-fit: cover; cursor:pointer;">
                                            @else
                                                <p class="text-muted mt-2">Tidak ada foto absen</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @else
                            <p class="text-muted">Belum ada dokumentasi untuk jadwal ini.</p>
                        @endif
                    </div>
                </div>

            <hr>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('scheduling.index') }}" class="btn btn-light border rounded-pill">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                @if($scheduling->documentation)
                    <a href="{{ route('documentations.edit', $scheduling->documentation->id) }}" class="btn btn-warning rounded-pill me-2">
                        <i class="fa fa-pencil"></i> Edit Dokumentasi
                    </a>
                    <form action="{{ route('documentations.destroy', $scheduling->documentation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
