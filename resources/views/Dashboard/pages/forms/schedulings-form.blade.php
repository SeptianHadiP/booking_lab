<!-- resources/views/dashboard/pages/forms/schedulings-form.blade.php -->
<form
    action="{{ isset($schedule) ? route('schedulings.update', $schedule->id) : route('schedulings.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6"
>
    @csrf
    @if(isset($schedule))
        @method('PUT')
    @endif

    {{-- Nama Lengkap --}}
    <div class="inputContainer">
        <input
            type="text"
            class="customInput"
            value="{{ Auth::user()->name }}"
            readonly
            placeholder=" "
        />
        <label class="inputLabel">Nama Lengkap</label>
        <div class="inputUnderline"></div>
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    </div>

    {{-- Semester Aktif --}}
    @php $activeSemester = \App\Models\Semester::getAktif(); @endphp
    @if($activeSemester)
        <div class="inputContainer">
            <input
                type="text"
                class="customInput"
                value="{{ $activeSemester->tahun_ajar }} ({{ \Illuminate\Support\Str::contains($activeSemester->id, '1') ? 'Ganjil' : 'Genap' }})"
                readonly
                placeholder=" "
            />
            <label class="inputLabel">Semester Aktif</label>
            <div class="inputUnderline"></div>
            <input type="hidden" name="semester_id" value="{{ $activeSemester->id }}">
        </div>
    @else
        <p class="text-sm text-red-600 mb-3">
            Tidak ada semester aktif saat ini. Silakan hubungi admin.
        </p>
    @endif

    {{-- Judul Praktikum --}}
    <div class="inputContainer">
        <input
            type="text"
            name="judul_praktikum"
            id="judul_praktikum"
            value="{{ old('judul_praktikum', $schedule->judul_praktikum ?? '') }}"
            class="customInput"
            placeholder=" "
            required
        />
        <label for="judul_praktikum" class="inputLabel">Judul Praktikum</label>
        <div class="inputUnderline"></div>
    </div>

    {{-- Kelas --}}
    <div class="inputContainer">
        <select
            name="kelas_id"
            id="kelas_id"
            class="customInput"
            required
        >
            <option value="" disabled {{ old('kelas_id', $schedule->kelas_id ?? '') ? '' : 'selected' }}>
                -- Pilih Kelas --
            </option>
            @foreach ($kelasList as $kelas)
                <option
                    value="{{ $kelas->id }}"
                    {{ old('kelas_id', $schedule->kelas_id ?? '') == $kelas->id ? 'selected' : '' }}
                >
                    {{ $kelas->nama_kelas }}
                </option>
            @endforeach
        </select>
        <label for="kelas_id" class="inputLabel">Kelas</label>
        <div class="inputUnderline"></div>
    </div>

    {{-- Tempat Lab --}}
    <div class="inputContainer">
        <select
            name="lab_id"
            id="lab_id"
            class="customInput"
            required
        >
            <option value="">-- Pilih Tempat Lab --</option>
            @foreach ($labList as $lab)
                <option
                    value="{{ $lab->id }}"
                    {{ old('lab_id', $schedule->lab_id ?? '') == $lab->id ? 'selected' : '' }}
                >
                    {{ $lab->nama_ruangan }}
                </option>
            @endforeach
        </select>
        <label for="lab_id" class="inputLabel">Tempat Lab</label>
        <div class="inputUnderline"></div>
    </div>

    {{-- Mata Kuliah --}}
    <div class="inputContainer">
        <select
            name="mata_kuliah_id"
            id="mata_kuliah_id"
            class="customInput"
            required
        >
            <option value="">-- Pilih Mata Kuliah --</option>
            @foreach ($mataKuliahList as $matkul)
                <option
                    value="{{ $matkul->id }}"
                    {{ old('mata_kuliah_id', $schedule->mata_kuliah_id ?? '') == $matkul->id ? 'selected' : '' }}
                >
                    {{ $matkul->nama_mata_kuliah }}
                </option>
            @endforeach
        </select>
        <label for="mata_kuliah_id" class="inputLabel">Mata Kuliah</label>
        <div class="inputUnderline"></div>
    </div>

    {{-- Tanggal --}}
    <div class="inputContainer">
        <input
            type="date"
            name="tanggal_praktikum"
            id="tanggal"
            value="{{ old('tanggal_praktikum', $schedule->tanggal_praktikum ?? '') }}"
            class="customInput @error('tanggal_praktikum') border-red-500 @enderror"
            placeholder=" "
            required
        />
        <label for="tanggal" class="inputLabel">Tanggal Praktikum</label>
        @error('tanggal_praktikum')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Waktu --}}
    <div class="inputContainer">
        <select
            name="waktu_praktikum"
            id="waktu"
            class="customInput @error('waktu_praktikum') border-red-500 @enderror"
            required
        >
            <option value="">-- Pilih Waktu --</option>
            @foreach([
                '08:00 - 10:30 (Sesi 1)',
                '10:46 - 12:30 (Sesi 2)',
                '13:30 - 15:30 (Sesi 3)',
                '15:45 - 18:00 (Sesi 4)'
            ] as $waktu)
                <option
                    value="{{ $waktu }}"
                    {{ old('waktu_praktikum', $schedule->waktu_praktikum ?? '') == $waktu ? 'selected' : '' }}
                >
                    {{ $waktu }}
                </option>
            @endforeach
        </select>
        <label for="waktu" class="inputLabel">Waktu Praktikum</label>
        @error('waktu_praktikum')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Upload Modul --}}
    <div class="inputContainer">
        <input
            type="file"
            id="modul"
            name="modul_praktikum"
            accept=".pdf,.doc,.docx"
            class="customInput @error('modul_praktikum') border-red-500 @enderror"
            {{ isset($schedule) ? '' : 'required' }}
        />
        <label for="modul" class="inputLabel">Upload Modul Praktikum</label>
        @error('modul_praktikum')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror

        @if(isset($schedule) && $schedule->modul_praktikum)
            <p class="text-sm text-gray-500 mt-1">
                File sebelumnya:
                <a href="{{ asset('storage/' . $schedule->modul_praktikum) }}"
                   target="_blank"
                   class="text-blue-600 underline">
                   Lihat
                </a>
            </p>
        @endif
    </div>

    {{-- Deskripsi --}}
    <div class="inputGroup">
        <textarea
            id="deskripsi"
            name="deskripsi"
            rows="3"
            required
        >{{ old('deskripsi', $schedule->deskripsi ?? '') }}</textarea>
        <label for="deskripsi">Deskripsi</label>
    </div>

    {{-- Tombol --}}
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t">
        <a
            href="{{ url()->previous() }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-600 shadow-sm hover:bg-gray-50"
        >
            <i class="fa fa-arrow-left mr-2"></i>
            <span>Batal</span>
        </a>

        <button
            type="submit"
            class="inline-flex items-center px-6 py-2 rounded-lg shadow-sm bg-blue-600 text-white hover:bg-blue-700"
        >
            <i class="fa {{ isset($schedule) ? 'fa-save' : 'fa-paper-plane' }} mr-2"></i>
            <span>{{ isset($schedule) ? 'Update' : 'Simpan' }}</span>
        </button>
    </div>
</form>

{{-- Style --}}
<style>
    .inputContainer {
        position: relative;
        margin-bottom: 14px;
    }
    .customInput {
        width: 100%;
        padding: 8px 6px;
        font-size: 14px;
        background-color: transparent;
        border: none;
        border-bottom: 2px solid rgb(200,200,200);
        outline: none;
        color: #111;
        transition: border-color 0.2s ease;
    }
    .customInput:focus,
    .customInput:not(:placeholder-shown) {
        border-color: rgb(150,150,200);
    }
    .inputLabel {
        position: absolute;
        top: 8px;
        left: 2px;
        pointer-events: none;
        font-size: 14px;
        color: rgb(100,100,100);
        transition: 0.25s ease;
    }
    .customInput:focus + .inputLabel,
    .customInput:not(:placeholder-shown) + .inputLabel,
    select.customInput:valid + .inputLabel {
        top: -8px;
        font-size: 12px;
        color: #000;
    }
    .inputUnderline {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: rgb(200,200,200);
    }
    .inputGroup {
        font-family: 'Segoe UI', sans-serif;
        margin: 1em 0;
        width: 100%;
        position: relative;
    }
    .inputGroup textarea {
        font-size: 100%;
        padding: 0.8em;
        outline: none;
        border: 2px solid rgb(200,200,200);
        background-color: transparent;
        border-radius: 6px;
        width: 100%;
        resize: vertical;
        min-height: 90px;
        color: #111;
        transition: border-color 0.2s ease;
    }
    .inputGroup label {
        font-size: 100%;
        position: absolute;
        left: 0;
        padding: 0.8em;
        margin-left: 0.5em;
        pointer-events: none;
        transition: all 0.3s ease;
        color: rgb(100,100,100);
    }
    .inputGroup :is(textarea:focus, textarea:valid) ~ label {
        transform: translateY(-50%) scale(.9);
        margin: 0;
        margin-left: 1.3em;
        padding: 0.4em;
        background-color: white;
        color: #000;
    }
    .inputGroup textarea:focus {
        border-color: rgb(150,150,200);
    }
</style>
