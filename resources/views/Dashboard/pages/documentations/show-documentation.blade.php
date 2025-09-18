@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <!-- Header -->
    <div class="bg-blue-600 text-white rounded-t-lg px-4 py-3 mb-6">
        <h5 class="text-lg font-semibold flex items-center gap-2">
            <i class="fa fa-info-circle"></i>
            Detail Jadwal & Dokumentasi Praktikum
        </h5>
    </div>

    <div class="text-base text-gray-700 space-y-6">
        <!-- Informasi Jadwal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <strong>👨‍🏫 Nama Dosen:</strong><br>
                <span>{{ $scheduling->user->name ?? 'Dosen tidak ditemukan' }}</span>
            </div>
            <div>
                <strong>📚 Mata Kuliah:</strong><br>
                <span>{{ $scheduling->mata_kuliah_praktikum->nama_mata_kuliah ?? 'Mata kuliah tidak ditemukan' }}</span>
            </div>
            <div>
                <strong>🏫 Kelas:</strong><br>
                <span>{{ $scheduling->kelas->nama_kelas ?? 'Kelas tidak ditemukan' }}</span>
            </div>
            <div>
                <strong>🏢 Tempat / Lab Praktikum:</strong><br>
                <span>{{ $scheduling->laboratorium->nama_ruangan ?? 'Laboratorium tidak ditemukan' }}</span>
            </div>
            <div>
                <strong>📅 Tanggal Praktikum:</strong><br>
                <span>{{ \Carbon\Carbon::parse($scheduling->tanggal_praktikum)->translatedFormat('l, d F Y') }}</span>
            </div>
            <div>
                <strong>⏰ Waktu Praktikum:</strong><br>
                <span>{{ $scheduling->waktu_praktikum }}</span>
            </div>
            <div class="md:col-span-2">
                <strong>🛠️ Tools / Software yang Digunakan:</strong><br>
                <span>{{ $scheduling->deskripsi }}</span>
            </div>
        </div>

        <hr>

        <!-- Dokumentasi Praktikum -->
        <div>
            <strong>📸 Dokumentasi Praktikum:</strong>
            <div class="mt-3 p-4 border rounded bg-gray-50">
                @if ($scheduling->documentation)
                    <!-- Info Dokumentasi -->
                    <div class="flex flex-wrap justify-between items-center mb-4">
                        <div>
                            <span class="font-semibold">Dibuat oleh:</span>
                            <span>{{ $scheduling->documentation->nama ?? '-' }}</span>
                        </div>
                        <div class="text-gray-500 text-sm">
                            {{ $scheduling->documentation->created_at->format('d M Y (H:i)') }}
                        </div>
                    </div>

                    <!-- Foto Utama -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border rounded bg-white shadow p-3 text-center">
                            <strong>Foto 1</strong><br>
                            @if ($scheduling->documentation->foto_1)
                                <img src="{{ asset('storage/' . $scheduling->documentation->foto_1) }}"
                                     alt="Foto 1"
                                     class="mt-2 rounded shadow cursor-pointer object-cover mx-auto"
                                     style="max-height: 250px;"
                                     data-img="{{ asset('storage/' . $scheduling->documentation->foto_1) }}">
                            @else
                                <p class="text-gray-400 mt-2">Tidak ada foto</p>
                            @endif
                        </div>

                        <div class="border rounded bg-white shadow p-3 text-center">
                            <strong>Foto 2</strong><br>
                            @if ($scheduling->documentation->foto_2)
                                <img src="{{ asset('storage/' . $scheduling->documentation->foto_2) }}"
                                     alt="Foto 2"
                                     class="mt-2 rounded shadow cursor-pointer object-cover mx-auto"
                                     style="max-height: 250px;"
                                     data-img="{{ asset('storage/' . $scheduling->documentation->foto_2) }}">
                            @else
                                <p class="text-gray-400 mt-2">Tidak ada foto</p>
                            @endif
                        </div>
                    </div>

                    <!-- Foto Absen -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="border rounded bg-white shadow p-3 text-center">
                            <strong>Foto Absen 1</strong><br>
                            @if ($scheduling->documentation->absen_1)
                                <img src="{{ Storage::url($scheduling->documentation->absen_1) }}"
                                     alt="Absen 1"
                                     class="mt-2 rounded shadow cursor-pointer object-cover mx-auto"
                                     style="max-height: 250px;"
                                     data-img="{{ Storage::url($scheduling->documentation->absen_1) }}">
                            @else
                                <p class="text-gray-400 mt-2">Tidak ada foto absen</p>
                            @endif
                        </div>

                        <div class="border rounded bg-white shadow p-3 text-center">
                            <strong>Foto Absen 2</strong><br>
                            @if ($scheduling->documentation->absen_2)
                                <img src="{{ Storage::url($scheduling->documentation->absen_2) }}"
                                     alt="Absen 2"
                                     class="mt-2 rounded shadow cursor-pointer object-cover mx-auto"
                                     style="max-height: 250px;"
                                     data-img="{{ Storage::url($scheduling->documentation->absen_2) }}">
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

        <hr>

        <!-- Tombol Aksi -->
        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('scheduling.index') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-600 shadow hover:bg-gray-50">
                <i class="fa fa-arrow-left mr-2"></i> Kembali
            </a>

            @if($scheduling->documentation)
                <a href="{{ route('documentations.edit', $scheduling->documentation->id) }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg bg-yellow-500 text-white shadow hover:bg-yellow-600">
                    <i class="fa fa-pencil mr-2"></i> Edit Dokumentasi
                </a>

                <form action="{{ route('documentations.destroy', $scheduling->documentation->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 rounded-lg bg-red-600 text-white shadow hover:bg-red-700">
                        <i class="fa fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
