@extends('dashboard.layouts.app')

@section('content')
<div class="container mt-3">
    <h4>Edit Dokumentasi Praktikum</h4>
    <form action="{{ route('documentations.update', $documentation->id) }}" method="POST" enctype="multipart/form-data">
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
            cancelButtonText: 'Tetap di Halaman Ini',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('documentations.index') }}";
            }
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menyimpan',
            text: 'Pastikan semua input valid dan file tidak melebihi batas ukuran.',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endpush
