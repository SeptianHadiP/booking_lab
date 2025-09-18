<!-- resources/views/dashboard/pages/certificates/result-certificate.blade.php -->
@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <!-- Header -->
    <div class="text-center mb-4">
        <h2 class="text-lg font-semibold text-green-600">✅ Sertifikat Berhasil Dibuat</h2>
        <p class="text-sm text-gray-500">Berikut adalah daftar sertifikat yang berhasil di-generate.</p>
    </div>

    <ul class="space-y-2">
        @forelse ($files as $file)
            <li class="flex justify-between items-center p-2 border rounded hover:bg-gray-50">
                <span class="text-gray-800 break-all">{{ $file }}</span>
                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 border border-blue-600 rounded hover:bg-blue-50">
                    🔗 Lihat Sertifikat
                </a>
            </li>
        @empty
            <li class="text-center text-gray-400 p-2 border rounded">
                Tidak ada sertifikat yang tersedia.
            </li>
        @endforelse
    </ul>


    <div class="text-center mt-6">
        <a href="{{ route('certificate.create', ['laprakId' => $laprakId]) }}"
        class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-200 text-gray-700 shadow hover:bg-gray-300">
            ⬅️ Kembali ke Form
        </a>
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
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

@if (session('error'))
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
