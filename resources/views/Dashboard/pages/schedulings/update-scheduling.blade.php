@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Edit Jadwal</h2>
            <p class="text-muted small mb-0">Perbarui jadwal praktikum yang telah dibuat</p>
        </div>
    </div>

    @include('dashboard.pages.forms.schedulings-form', ['schedule' => $schedule])
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showCancelButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: 'Tetap di Halaman Ini',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('scheduling.index') }}";
            }
        });
    </script>
@endif

@if ($errors->has('tanggal_praktikum'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Jadwal Bentrok',
            text: '{{ $errors->first("tanggal_praktikum") }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endpush
