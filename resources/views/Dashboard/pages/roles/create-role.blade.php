@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Buat Role</h2>
            <p class="text-muted small mb-0">Masukkan informasi role dan hak akses</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger small">
            <strong class="d-block mb-2">Oops! Ada kesalahan:</strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
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

    @include('dashboard.pages.forms.role-form')
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
                window.location.href = "{{ route('scheduling.index') }}";
            }
        });
    </script>
@elseif ($errors->has('tanggal_praktikum'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Jadwal Bentrok',
            text: '{{ $errors->first("tanggal_praktikum") }}',
            confirmButtonText: 'OK'
        });
    </script>
@elseif (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session("error") }}',
            confirmButtonText: 'Coba Lagi'
        });
    </script>
@endif
@endpush
