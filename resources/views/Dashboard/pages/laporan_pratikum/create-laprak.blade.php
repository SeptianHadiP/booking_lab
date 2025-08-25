@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Upload Laporan Praktikum</h2>
            <p class="text-muted small mb-0">Unggah laporan, pilih kelas, semester, dan file nilai.</p>
        </div>
    </div>

    <form action="{{ route('laprak.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Upload Laporan --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Upload File Laporan (PDF/DOCX)</label>
            <input type="file" name="laporan_file" class="form-control" accept=".pdf,.doc,.docx" required>
        </div>

        {{-- Pilih Kelas --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Kelas</label>
            <select name="kelas" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelasList as $kelas)
                    <option value="{{ $kelas }}">{{ $kelas }}</option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Semester --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Semester</label>
            <select name="semester" class="form-select" required>
                <option value="">-- Pilih Semester --</option>
                <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
        </div>

        {{-- Upload File Nilai --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Upload File Nilai (Excel .xlsx)</label>
            <input type="file" name="nilai_file" class="form-control" accept=".xlsx,.xls,.csv" required>
        </div>

        {{-- Submit Button --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100 fw-bold">
                Simpan Laporan Praktikum
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
