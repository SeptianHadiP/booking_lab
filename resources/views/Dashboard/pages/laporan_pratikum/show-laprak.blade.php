<!-- resources/views/dashboard/pages/laporan_pratikum/show-laprak.blade.php -->
@extends('dashboard.layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 text-white px-6 py-4">
            <h5 class="text-lg font-semibold flex items-center gap-2">
                <i class="fa fa-file-text-o"></i> Informasi Laporan Praktikum
            </h5>
        </div>

        <!-- Body -->
        <div class="p-6 text-gray-800 text-base">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <strong>👨‍🏫 Nama Pengunggah:</strong><br>
                    <span>{{ $laprak->user->name ?? '-' }}</span>
                </div>
                <div>
                    <strong>📚 Mata Kuliah:</strong><br>
                    <span>{{ $laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? '-' }}</span>
                </div>
                <div>
                    <strong>🏫 Kelas:</strong><br>
                    <span>{{ $laprak->kelas->nama_kelas ?? '-' }}</span>
                </div>
                <div>
                    <strong>🎓 Tahun Ajaran:</strong><br>
                    <span>{{ $laprak->semester->tahun_ajar ?? '-' }}</span>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <strong>📄 File Laporan:</strong><br>
                    @if($laprak->laporan_file)
                        <a href="{{ asset('storage/' . $laprak->laporan_file) }}" target="_blank"
                           class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 transition">
                            <i class="fa fa-file-pdf-o"></i> Lihat Laporan
                        </a>
                    @else
                        <span class="text-gray-400">Belum ada file laporan</span>
                    @endif
                </div>
                <div class="col-span-1 md:col-span-2">
                    <strong>📊 File Nilai:</strong><br>
                    @if($laprak->nilai_file)
                        <a href="{{ asset('storage/' . $laprak->nilai_file) }}" target="_blank"
                           class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 border border-green-600 text-green-600 rounded hover:bg-green-50 transition">
                            <i class="fa fa-file-excel-o"></i> Lihat Nilai
                        </a>
                    @else
                        <span class="text-gray-400">Belum ada file nilai</span>
                    @endif
                </div>

                {{-- Sertifikat --}}
                <div class="col-span-1 md:col-span-2">
                    <strong>🏅 Sertifikat:</strong><br>
                    @php
                        use Illuminate\Support\Facades\Storage;
                        use Illuminate\Support\Str;

                        $tahunAjaran = Str::slug($laprak->semester->tahun_ajar ?? date('Y'));
                        $mataKuliah  = Str::slug($laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? 'mata-kuliah');
                        $kelas       = Str::slug($laprak->kelas->nama_kelas ?? 'kelas');

                        $basePath = "generated_certificates/{$tahunAjaran}/{$mataKuliah}/{$kelas}";
                        $hasCertificates = Storage::disk('public')->exists($basePath)
                            && count(Storage::disk('public')->files($basePath)) > 0;
                    @endphp

                    @if($hasCertificates)
                        <a href="{{ route('laprak.certificates', $laprak->id) }}"
                        target="_blank" {{-- Ini akan buka di tab/halaman baru --}}
                        class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 border border-purple-600 text-purple-600 rounded hover:bg-purple-50 transition">
                            <i class="fa fa-certificate"></i> Lihat Semua Sertifikat
                        </a>
                    @else
                        <span class="text-gray-400">Tunggu Aslab atau Kalab membuat sertifikat</span>
                    @endif
                </div>

            <hr class="my-6">
            <div class="flex flex-wrap justify-between gap-3">
                {{-- Tombol Kembali --}}
                <a href="{{ route('laprak.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 border rounded-full bg-white hover:bg-gray-50 transition text-gray-700">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

                <div class="flex flex-wrap gap-3">
                    {{-- Edit Laporan --}}
                    @can('edit laprak', $laprak)
                        <a href="{{ route('laprak.edit', $laprak->id) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-500 text-white hover:bg-yellow-600 transition">
                            <i class="fa fa-pencil"></i> Ubah Laporan
                        </a>
                    @endcan

                    {{-- Hapus Laporan --}}
                    @can('delete laprak', $laprak)
                        <form action="{{ route('laprak.destroy', $laprak->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-600 text-white hover:bg-red-700 transition">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
