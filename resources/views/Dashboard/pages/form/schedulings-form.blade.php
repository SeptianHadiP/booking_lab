<form action="{{ isset($schedule) ? route('scheduling.update', $schedule->id) : route('scheduling.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($schedule))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama_dosen"
            value="{{ old('nama_dosen', $schedule->nama_dosen ?? '') }}"
            placeholder="Masukkan nama lengkap dosen" required>
    </div>

    <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <input type="text" class="form-control" id="kelas" name="kelas"
            value="{{ old('kelas', $schedule->kelas ?? '') }}"
            placeholder="Contoh: F1A1" required>
    </div>

    <div class="mb-3">
        <label for="matkul" class="form-label">Mata Kuliah</label>
        @php
            $matkuls = [
                'Analisis dan Desain Berorientasi Objek',
                'Jaringan Komputer II',
                'Pemograman Web',
                'Penambangan Data',
                'Pengantar Keamanan Komputer',
                'Sistem Basis Data',
                'Statistika dan Probabilitas'
            ];
        @endphp
        <select class="form-select" id="matkul" name="mata_kuliah" required>
            <option value="">-- Pilih Mata Kuliah --</option>
            @foreach ($matkuls as $matkul)
                <option value="{{ $matkul }}"
                    {{ old('mata_kuliah', $schedule->mata_kuliah ?? '') == $matkul ? 'selected' : '' }}>
                    {{ $matkul }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal Praktikum</label>
        <input type="date"
            class="form-control @error('tanggal_praktikum') is-invalid @enderror"
            id="tanggal"
            name="tanggal_praktikum"
            value="{{ old('tanggal_praktikum', $schedule->tanggal_praktikum ?? '') }}"
            required>
        @error('tanggal_praktikum')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="waktu" class="form-label">Waktu Praktikum</label>
        <select class="form-select @error('waktu_praktikum') is-invalid @enderror"
                id="waktu" name="waktu_praktikum" required>
            <option value="">-- Pilih Waktu --</option>
            @foreach([
                '08:00 - 10:30 (Sesi 1)',
                '10:46 - 12:30 (Sesi 2)',
                '13:30 - 15:30 (Sesi 3)',
                '15:45 - 18:00 (Sesi 4)'
            ] as $waktu)
                <option value="{{ $waktu }}"
                    {{ old('waktu_praktikum', $schedule->waktu_praktikum ?? '') == $waktu ? 'selected' : '' }}>
                    {{ $waktu }}
                </option>
            @endforeach
        </select>
        @error('waktu_praktikum')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="modul" class="form-label">Upload Modul Praktikum</label>
        <input type="file"
            class="form-control @error('modul_praktikum') is-invalid @enderror"
            id="modul" name="modul_praktikum"
            accept=".pdf,.doc,.docx"
            {{ isset($schedule) ? '' : 'required' }}>
        @error('modul_praktikum')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if (isset($schedule) && $schedule->modul_praktikum)
            <small class="text-muted">File sebelumnya: <a href="{{ asset('storage/' . $schedule->modul_praktikum) }}" target="_blank">Lihat</a></small>
        @endif
        @if ($errors->any())
            <small class="text-muted d-block mt-1">* Silakan upload ulang file karena input file tidak tersimpan otomatis.</small>
        @endif
    </div>

    <div class="mb-3">
        <label for="tools" class="form-label">Tools / Software yang Digunakan</label>
        <textarea class="form-control" id="tools" name="tools_software" rows="3" required
            placeholder="Contoh: Visual Studio Code, XAMPP, Wireshark">{{ old('tools_software', $schedule->tools_software ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($schedule) ? 'Update Jadwal' : 'Daftar Praktikum' }}
    </button>
</form>
