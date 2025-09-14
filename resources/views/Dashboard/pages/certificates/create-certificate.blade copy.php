@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <!-- Header -->
    <div class="flex flex-wrap items-start justify-between gap-2 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Generate Sertifikat</h2>
            <p class="text-sm text-gray-500">Unggah data peserta dan pilih template sertifikat.</p>
        </div>
    </div>

    @if (session('success') && session('alert_type') == 'auto')
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

    <form action="{{ route('generate.certificates') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('dashboard.pages.forms.certificate-form')
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
            confirmButtonText: 'Kembali ke Daftar',
            cancelButtonText: 'Tetap di Form',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('certificates.index') }}";
            }
        });
    </script>
@elseif ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endpush
