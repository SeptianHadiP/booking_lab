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
                    <span class="text-dark">{{ $schedule->user->name ?? 'Dosen tidak ditemukan' }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>📚 Mata Kuliah:</strong><br>
                    <span class="text-dark">{{ $schedule->mata_kuliah_praktikum->nama_mata_kuliah ?? 'Mata kuliah tidak ditemukan' }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>🏫 Kelas:</strong><br>
                    <span class="text-dark">{{ $schedule->kelas->nama_kelas ?? 'Kelas tidak ditemukan' }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>🏢 Tempat / Lab Praktikum:</strong><br>
                    <span class="text-dark">{{ $schedule->laboratorium->nama_ruangan ?? 'Laboratorium tidak ditemukan' }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>📅 Tanggal Praktikum:</strong><br>
                    <span class="text-dark">{{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>⏰ Waktu Praktikum:</strong><br>
                    <span class="text-dark">{{ $schedule->waktu_praktikum }}</span>
                </div>

                <x-button.can permission="distroy role">
                    <div class="col-md-12 mb-3">
                        <strong>🛠️ Tools / Software yang Digunakan:</strong><br>
                        <span class="text-dark">{{ $schedule->deskripsi }}</span>
                    </div>
                </x-button.can>

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

                <hr>

                {{-- Dokumentasi Praktikum --}}
                <div class="col-md-12 mb-4">
                    <strong>📸 Dokumentasi Praktikum:</strong>
                    <div class="mt-2 p-3 border rounded-3 bg-light">
                        @if ($schedule->documentation)
                            <div class="mb-2 d-flex justify-content-between">
                                <div>
                                    <span class="fw-bold">Buat oleh:</span>
                                    <span class="text-dark">{{ $schedule->documentation->nama ?? '-' }}</span>
                                </div>
                                <div>
                                    <span class="text-dark">
                                        {{ $schedule->documentation->created_at->format('d M Y (H:i)') }}
                                    </span>
                                </div>
                            </div>

                            <div class="row g-3">
                                {{-- Foto 1 --}}
                                <div class="col-md-6 text-center">
                                    <div class="border rounded p-2 bg-white shadow-sm h-100">
                                        <strong>Foto 1</strong>
                                        @if ($schedule->documentation->foto_1)<br>
                                            <img src="{{ asset('storage/' . $schedule->documentation->foto_1) }}"
                                                alt="Foto 1"
                                                class="img-fluid rounded mt-2 popup-img"
                                                data-img="{{ asset('storage/' . $schedule->documentation->foto_1) }}"
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
                                        @if ($schedule->documentation->foto_2)<br>
                                            <img src="{{ asset('storage/' . $schedule->documentation->foto_2) }}"
                                                alt="Foto 2"
                                                class="img-fluid rounded mt-2 popup-img"
                                                data-img="{{ asset('storage/' . $schedule->documentation->foto_2) }}"
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
                                            @if ($schedule->documentation->absen_1)
                                                <img src="{{ Storage::url($schedule->documentation->absen_1) }}"
                                                    alt="Absen 1"
                                                    class="img-fluid rounded mt-2 popup-img"
                                                    data-img="{{ Storage::url($schedule->documentation->absen_1) }}"
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
                                            @if ($schedule->documentation->absen_2)
                                                <img src="{{ Storage::url($schedule->documentation->absen_2) }}"
                                                    alt="Absen 2"
                                                    class="img-fluid rounded mt-2 popup-img"
                                                    data-img="{{ Storage::url($schedule->documentation->absen_2) }}"
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

{{-- Modal Popup Gambar --}}
<div id="imgModal" class="modal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow:auto; background:rgba(0,0,0,0.8);">
    <span id="closeModal" style="position:absolute; top:20px; right:35px; color:white; font-size:40px; font-weight:bold; cursor:pointer;">&times;</span>
    <div style="text-align:center; margin-top:50px;">
        <img id="modalImg" style="max-width:90%; max-height:80vh; border-radius:10px;">
        <br>
        <a id="downloadBtn" href="#" download class="btn btn-success mt-3"><i class="fa fa-download"></i> Download</a>
    </div>
</div>

{{-- Script Popup --}}
<script>
document.addEventListener("DOMContentLoaded", function(){
    const modal = document.getElementById("imgModal");
    const modalImg = document.getElementById("modalImg");
    const downloadBtn = document.getElementById("downloadBtn");
    const closeModal = document.getElementById("closeModal");

    document.querySelectorAll(".popup-img").forEach(img => {
        img.addEventListener("click", function(){
            modal.style.display = "block";
            modalImg.src = this.dataset.img;
            downloadBtn.href = this.dataset.img;
        });
    });

    closeModal.addEventListener("click", function(){
        modal.style.display = "none";
    });

    window.addEventListener("click", function(e){
        if(e.target === modal){
            modal.style.display = "none";
        }
    });
});
</script>
@endsection
