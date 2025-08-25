@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Generate Sertifikat</h2>
            <p class="text-muted small mb-0">Unggah data peserta dan pilih template sertifikat.</p>
        </div>
    </div>

    <form action="{{ route('generate.certificates') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Upload Excel --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Upload Excel File (.xlsx / .csv)</label>
            <input type="file" name="spreadsheet" class="form-control" required>
        </div>

        {{-- Pilih Template --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Template Sertifikat</label>
            <select name="template_id" class="form-select" required>
                @foreach ($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Submit Button --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-primary w-100 fw-bold">
                Generate Sertifikat
            </button>
        </div>
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
