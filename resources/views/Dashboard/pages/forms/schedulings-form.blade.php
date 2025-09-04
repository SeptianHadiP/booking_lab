<form action="{{ isset($schedule) ? route('schedulings.update', $schedule->id) : route('schedulings.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($schedule))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama"
            value="{{ Auth::user()->name }}" readonly>

        {{-- Hidden field untuk mengirim user_id --}}
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    </div>

    <div class="mb-3">
        <label for="judul_praktikum" class="form-label">Judul Praktikum</label>
        <input type="text" class="form-control" name="judul_praktikum" id="judul_praktikum"
            value="{{ old('judul_praktikum', $schedule->judul_praktikum ?? '') }}"
            placeholder="Contoh: Praktikum Analisis Numerik - Iterasi Jacobi" required>
    </div>

    <div class="form-group mb-3">
        <label for="kelas_id">Kelas</label>
        <select name="kelas_id" id="kelas_id" class="form-control" required>
            <option value="" disabled selected>-- Pilih Kelas --</option>
            @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->id }}"
                    {{ old('kelas_id', $schedule->kelas_id ?? '') == $kelas->id ? 'selected' : '' }}>
                    {{ $kelas->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="lab_id" class="form-label">Tempat Lab</label>
        <select class="form-select" id="lab_id" name="lab_id" required>
            <option value="">-- Pilih Tempat Lab --</option>
            @foreach ($labList as $lab)
                <option value="{{ $lab->id }}"
                    {{ old('lab_id', $schedule->lab_id ?? '') == $lab->id ? 'selected' : '' }}>
                    {{ $lab->nama_ruangan }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
        <select name="mata_kuliah_id" id="mata_kuliah_id" class="form-select" required>
            <option value="">-- Pilih Mata Kuliah --</option>
            @foreach ($mataKuliahList as $matkul)
                <option value="{{ $matkul->id }}"
                    {{ old('mata_kuliah_id', $schedule->mata_kuliah_id ?? '') == $matkul->id ? 'selected' : '' }}>
                    {{ $matkul->nama_mata_kuliah }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="semester_id" class="form-label">Semester / Tahun Ajar</label>
        <select name="semester_id" id="semester_id" class="form-select" required>
            <option value="">-- Pilih Semester --</option>
            @foreach ($semesters as $semester)
                <option value="{{ $semester->id }}"
                    {{ old('semester_id', $schedule->semester_id ?? '') == $semester->id ? 'selected' : '' }}>
                    {{ $semester->nama_semester }} ({{ $semester->tahun_ajar }})
                    @if($semester->is_active) - [Aktif] @endif
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
        <label for="tools" class="form-label">deskripsi</label>
        <textarea class="form-control" id="tools" name="deskripsi" rows="3" required
            placeholder="Contoh: Visual Studio Code, XAMPP, Wireshark">{{ old('deskripsi', $schedule->deskripsi ?? '') }}</textarea>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        {{-- Tombol Kembali --}}
        <a href="{{ url()->previous() }}" class="btn btn-light border d-flex align-items-center shadow-sm px-3">
            <i class="fa fa-arrow-left me-2 text-secondary"></i>
            <span class="text-secondary fw-semibold">Batal</span>
        </a>

        {{-- Tombol Submit --}}
        <button type="submit" class="btn btn-primary d-flex align-items-center px-4 shadow-sm">
            <i class="fa {{ isset($schedule) ? 'fa-save' : 'fa-paper-plane' }} me-2"></i>
            <span>{{ isset($schedule) ? 'Update' : 'Simpan' }}</span>
        </button>

    </div>
</form>
