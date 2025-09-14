@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-1">Buat Role</h2>
            <p class="text-sm text-gray-500">Masukkan informasi role dan hak akses</p>
        </div>
        <a href="{{ route('roles.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded transition">
            ← Kembali
        </a>
    </div>

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-6 text-sm">
            <strong class="block mb-2">Oops! Ada kesalahan:</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SweetAlert Success Auto --}}
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

    <!-- Form -->
    <div>
        @include('dashboard.pages.forms.role-form')
    </div>

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
                window.location.href = "{{ route('roles.index') }}";
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
