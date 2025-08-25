@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <div class="text-center mb-4">
        <h2 class="h4 fw-semibold text-success">✅ Sertifikat Berhasil Dibuat</h2>
        <p class="text-muted small">Berikut adalah daftar sertifikat yang berhasil di-generate.</p>
    </div>

    <ul class="list-group mb-4">
        @forelse ($generatedCertificates as $file)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $file }}</span>
                <a href="{{ asset('storage/generated_certificates/' . $file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    🔗 Lihat Sertifikat
                </a>
            </li>
        @empty
            <li class="list-group-item text-center text-muted">
                Tidak ada sertifikat yang tersedia.
            </li>
        @endforelse
    </ul>

    <div class="text-center">
        <a href="{{ route('certificate.create') }}" class="btn btn-secondary">
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
