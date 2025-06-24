@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Tambah Dokumentasi</h2>
            <p class="text-muted small mb-0">Unggah dokumentasi kegiatan praktikum</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('documentations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('dashboard.pages.forms.documentation-form')
    </form>
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
                window.location.href = "{{ route('documentation.index') }}";
            }
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if (session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: '{{ session("warning") }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endpush
