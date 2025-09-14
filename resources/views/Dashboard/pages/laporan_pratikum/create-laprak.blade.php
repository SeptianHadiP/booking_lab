<!-- resources/views/dashboard/pages/laporan_pratikum/create-laprak.blade.php -->
@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <!-- Header -->
    <div class="flex flex-wrap items-start justify-between gap-2 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Upload Laporan Praktikum</h2>
            <p class="text-sm text-gray-500">Unggah laporan, pilih mata kuliah, kelas, dan tahun ajaran.</p>
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
