<!-- resources/views/dashboard/pages/laporan_pratikum/create-laprak.blade.php -->
@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <!-- Header -->
    <div class="flex flex-wrap items-start justify-between gap-2 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Upload Laporan Praktikum</h2>
            <p class="text-sm text-gray-500">Silakan unggah laporan praktikum sesuai mata kuliah, kelas, dan tahun ajaran yang dipilih. <br>
                Gunakan template resmi yang telah disediakan:
            </p><br>
            <span class="text-sm text-gray-500">Pastikan mengikuti format yang disediakan: <br>
                <a href="{{ asset('assets/file_template/Nilai_Praktikum_Jaringan_Komputer_1_F3A1.xlsx') }}" target="_blank" download
                class="text-blue-600 underline hover:text-blue-800 hover:underline font-medium transition">
                    Format Excel Nilai Praktikum
                </a> (wajib untuk penilaian)<br>
                <a href="{{ asset('assets/file_template/Nilai_Praktikum_Jaringan_Komputer_1_F3A1.xlsx') }}" target="_blank" download
                class="text-blue-600 underline hover:text-blue-800 hover:underline font-medium transition">
                    Format Laporan Praktikum
                </a> (wajib untuk laporan)<br>
                <p>
                    * File laporan diunggah dalam format <strong>PDF/DOCX</strong> dan file nilai dalam format <strong>Excel</strong>.
                </p>
            </span>
        </div>  
    </div>

    {{-- Auto Success Toast --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        </script>
    @endif

    {{-- Include Form --}}
    @include('dashboard.pages.forms.laprak-form')
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success') && session('alert_type') != 'auto')
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        showCancelButton: true,
        confirmButtonText: 'Kembali ke Daftar',
        cancelButtonText: 'Tetap di Form',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('laprak.index') }}";
        }
    });
</script>
@endif
@endpush
