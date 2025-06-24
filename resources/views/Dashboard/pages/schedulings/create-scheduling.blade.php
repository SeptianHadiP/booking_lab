@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Tambah Jadwal</h2>
            <p class="text-muted small mb-0">Kelola jadwal praktikum yang ingin ditambahkan</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- @include('dashboard.pages.forms.documentation-form') -->
    @include('dashboard.pages.forms.schedulings-form')
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
            cancelButtonText: 'Tetap di Form',
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
