@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-1">Edit Jadwal</h2>
            <p class="text-sm text-gray-500">Perbarui jadwal praktikum yang telah dibuat</p>
        </div>
    </div>

    {{-- SweetAlert auto success --}}
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

    {{-- Form edit --}}
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
