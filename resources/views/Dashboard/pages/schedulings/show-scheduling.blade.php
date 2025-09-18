@extends('dashboard.layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 text-white px-6 py-4">
            <h5 class="text-lg font-semibold flex items-center gap-2">
                <i class="fa fa-info-circle"></i> Informasi Jadwal Praktikum
            </h5>
        </div>

        <!-- Body -->
        <div class="p-6 text-gray-800 text-base">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <strong>👨‍🏫 Nama Dosen:</strong><br>
                    <span>{{ $schedule->user->name ?? 'Dosen tidak ditemukan' }}</span>
                </div>
                <div>
                    <strong>📚 Mata Kuliah:</strong><br>
                    <span>{{ $schedule->mata_kuliah_praktikum->nama_mata_kuliah ?? 'Mata kuliah tidak ditemukan' }}</span>
                </div>
                <div>
                    <strong>🏫 Kelas:</strong><br>
                    <span>{{ $schedule->kelas->nama_kelas ?? 'Kelas tidak ditemukan' }}</span>
                </div>
                <div>
                    <strong>🎓 Tahun Ajaran:</strong><br>
                    <span>{{ $schedule->semester->tahun_ajar ?? '-' }}</span>
                </div>
                <div>
                    <strong>🏢 Tempat / Lab Praktikum:</strong><br>
                    <span>{{ $schedule->laboratorium->nama_ruangan ?? 'Laboratorium tidak ditemukan' }}</span>
                </div>
                <div>
                    <strong>📅 Tanggal Praktikum:</strong><br>
                    <span>{{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div>
                    <strong>⏰ Waktu Praktikum:</strong><br>
                    <span>{{ $schedule->waktu_praktikum }}</span>
                </div>
                <x-button.can permission="distroy role">
                    <div class="col-span-1 md:col-span-2">
                        <strong>🛠️ Tools / Software yang Digunakan:</strong><br>
                        <span>{{ $schedule->deskripsi }}</span>
                    </div>
                </x-button.can>

                <div class="col-span-1 md:col-span-2">
                    <strong>📄 Modul Praktikum:</strong><br>
                    @if ($schedule->modul_praktikum)
                        <a href="{{ asset('storage/' . $schedule->modul_praktikum) }}" target="_blank"
                            class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 transition">
                            <i class="fa fa-file-pdf-o"></i> Lihat Modul
                        </a>
                    @else
                        <span class="text-gray-400">Belum ada modul yang diunggah</span>
                    @endif
                </div>
            </div>

            <hr class="my-6">

            {{-- Dokumentasi Praktikum --}}
            <div>
                <strong>📸 Dokumentasi Praktikum:</strong>
                <div class="mt-3 p-4 border rounded-lg bg-gray-50">
                    @if ($schedule->documentation)
                        <div class="flex justify-between mb-4 text-gray-700">
                            <div>
                                <span class="font-semibold">Buat oleh:</span>
                                <span>{{ $schedule->documentation->nama ?? '-' }}</span>
                            </div>
                            <div>
                                {{ $schedule->documentation->created_at->format('d M Y (H:i)') }}
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Foto 1 --}}
                            <div class="text-center p-4 bg-white border rounded-lg shadow">
                                <strong>Foto 1</strong>
                                @if ($schedule->documentation->foto_1)
                                    <img src="{{ asset('storage/' . $schedule->documentation->foto_1) }}"
                                        alt="Foto 1"
                                        class="mt-2 w-full h-60 object-cover rounded cursor-pointer popup-img"
                                        data-img="{{ asset('storage/' . $schedule->documentation->foto_1) }}">
                                @else
                                    <p class="text-gray-400 mt-2">Tidak ada foto</p>
                                @endif
                            </div>

                            {{-- Absen 1 --}}
                            <div class="text-center p-4 bg-white border rounded-lg shadow">
                                <strong>Foto Absen 1</strong>
                                @if ($schedule->documentation->absen_1)
                                    <img src="{{ Storage::url($schedule->documentation->absen_1) }}"
                                        alt="Absen 1"
                                        class="mt-2 w-full h-60 object-cover rounded cursor-pointer popup-img"
                                        data-img="{{ Storage::url($schedule->documentation->absen_1) }}">
                                @else
                                    <p class="text-gray-400 mt-2">Tidak ada foto absen</p>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            {{-- Foto 2 --}}
                            <div class="text-center p-4 bg-white border rounded-lg shadow">
                                <strong>Foto 2</strong>
                                @if ($schedule->documentation->foto_2)
                                    <img src="{{ asset('storage/' . $schedule->documentation->foto_2) }}"
                                        alt="Foto 2"
                                        class="mt-2 w-full h-60 object-cover rounded cursor-pointer popup-img"
                                        data-img="{{ asset('storage/' . $schedule->documentation->foto_2) }}">
                                @else
                                    <p class="text-gray-400 mt-2">Tidak ada foto</p>
                                @endif
                            </div>

                            {{-- Absen 2 --}}
                            <div class="text-center p-4 bg-white border rounded-lg shadow">
                                <strong>Foto Absen 2</strong>
                                @if ($schedule->documentation->absen_2)
                                    <img src="{{ Storage::url($schedule->documentation->absen_2) }}"
                                        alt="Absen 2"
                                        class="mt-2 w-full h-60 object-cover rounded cursor-pointer popup-img"
                                        data-img="{{ Storage::url($schedule->documentation->absen_2) }}">
                                @else
                                    <p class="text-gray-400 mt-2">Tidak ada foto absen</p>
                                @endif
                            </div>
                        </div>

                    @else
                        <p class="text-gray-400">Belum ada dokumentasi untuk jadwal ini.</p>
                    @endif
                </div>
            </div>

            <hr class="my-6">
            <div class="flex flex-wrap justify-between gap-3">
                {{-- Tombol Kembali --}}
                <a href="{{ route('scheduling.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 border rounded-full bg-white hover:bg-gray-50 transition text-gray-700">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

                <div class="flex flex-wrap gap-3">
                    {{-- Edit Jadwal --}}
                    @can('edit scheduling', $schedule)
                        <a href="{{ route('schedulings.edit', $schedule->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-500 text-white hover:bg-yellow-600 transition">
                            <i class="fa fa-pencil"></i> Ubah Jadwal
                        </a>
                    @endcan

                    {{-- Edit Dokumentasi --}}
                    @can('edit documentation', App\Models\Documentation::class)
                        @if($schedule->documentation)
                            <a href="{{ route('documentations.edit', $schedule->documentation->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-500 text-white hover:bg-yellow-600 transition">
                                <i class="bi bi-pencil-square"></i> Ubah Dokumentasi
                            </a>
                        @endif
                    @endcan

                    {{-- Hapus Jadwal --}}
                    <form action="{{ route('schedulings.destroy', $schedule->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-600 text-white hover:bg-red-700 transition">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Modal Popup Gambar --}}
<div id="imgModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-80 flex items-start justify-center overflow-auto p-6">
    <span id="closeModal" class="absolute top-5 right-5 text-white text-4xl font-bold cursor-pointer">&times;</span>
    <div class="text-center mt-12">
        <img id="modalImg" class="max-w-[90%] max-h-[80vh] rounded-lg">
        <br>
        <a id="downloadBtn" href="#" download
            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            <i class="fa fa-download"></i> Download
        </a>
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
            modal.classList.remove("hidden");
            modalImg.src = this.dataset.img;
            downloadBtn.href = this.dataset.img;
        });
    });

    closeModal.addEventListener("click", function(){
        modal.classList.add("hidden");
    });

    window.addEventListener("click", function(e){
        if(e.target === modal){
            modal.classList.add("hidden");
        }
    });
});
</script>
@endsection
