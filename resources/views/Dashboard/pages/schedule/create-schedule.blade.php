@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
<!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Tambah Jadwal</h2>
            <p class="text-muted small mb-0">Manage all your class</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-success">
            Back
        </a>
    </div>

    <!-- Form -->    
    <form action="/submit-praktikum" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap Dosen</label>
            <input type="text" class="form-control" id="nama" name="nama_dosen" placeholder="Masukkan nama lengkap dosen" required>
        </div>

        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Contoh: F1A1" required>
        </div>

        <div class="mb-3">
            <label for="matkul" class="form-label">Mata Kuliah</label>
            <select class="form-select" id="matkul" name="mata_kuliah" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                <option value="Analisis dan Desain Berorientasi Objek">Analisis dan Desain Berorientasi Objek</option>
                <option value="Jaringan Komputer II">Jaringan Komputer II</option>
                <option value="Pemograman Web">Pemograman Web</option>
                <option value="Penambangan Data">Penambangan Data</option>
                <option value="Pengantar Keamanan Komputer">Pengantar Keamanan Komputer</option>
                <option value="Sistem Basis Data">Sistem Basis Data</option>
                <option value="Statistika dan Probabilitas">Statistika dan Probabilitas</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Praktikum</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal_praktikum" required>
        </div>

        <div class="mb-3">
            <label for="waktu" class="form-label">Waktu Praktikum</label>
            <select class="form-select" id="waktu" name="waktu_praktikum" required>
                <option value="">-- Pilih Waktu --</option>
                <option value="08:00 - 10:30">08:00 - 10:30 (Sesi 1)</option>
                <option value="10:46 - 12:30">10:46 - 12:30 (Sesi 2)</option>
                <option value="13:30 - 15:30">13:30 - 15:30 (Sesi 3)</option>
                <option value="15:45 - 18:00">15:45 - 18:00 (Sesi 4)</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="modul" class="form-label">Upload Modul Praktikum</label>
            <input type="file" class="form-control" id="modul" name="modul_praktikum" accept=".pdf,.doc,.docx" required>
        </div>

        <div class="mb-3">
            <label for="tools" class="form-label">Tools / Software yang Digunakan</label>
            <textarea class="form-control" id="tools" name="tools_software" rows="3" placeholder="Contoh: Visual Studio Code, XAMPP, Wireshark" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Daftar Praktikum</button>
    </form>
</div>
@endsection

