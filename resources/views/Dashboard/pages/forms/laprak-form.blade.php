<!-- resources/views/laprak/form.blade.php -->
<form action="{{ isset($laprak) ? route('laprak.update', $laprak->id) : route('laprak.store') }}"
      method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if(isset($laprak))
        @method('PUT')
    @endif

    <!-- Nama Lengkap (readonly) -->
    <div class="inputContainer">
        <input type="text" class="customInput"
               value="{{ $laprak->user->name ?? Auth::user()->name }}"
               readonly placeholder=" " />
        <label class="inputLabel">Nama Lengkap</label>
        <div class="inputUnderline"></div>
        <input type="hidden" name="user_id" value="{{ $laprak->user_id ?? Auth::id() }}">
    </div>

    <!-- Mata Kuliah -->
    <div class="inputContainer">
        <select name="mata_kuliah_id" id="mata_kuliah_id" required class="customInput">
            <option value="" disabled {{ old('mata_kuliah_id', $laprak->mata_kuliah_id ?? '') ? '' : 'selected' }}>-- Pilih Mata Kuliah --</option>
            @foreach ($mataKuliahList as $mk)
                <option value="{{ $mk->id }}" {{ old('mata_kuliah_id', $laprak->mata_kuliah_id ?? '') == $mk->id ? 'selected' : '' }}>
                    {{ $mk->nama_mata_kuliah }}
                </option>
            @endforeach
        </select>
        <label for="mata_kuliah_id" class="inputLabel">Mata Kuliah</label>
        <div class="inputUnderline"></div>
        <x-input-error :messages="$errors->get('mata_kuliah_id')" class="mt-2" />
    </div>

    <!-- Kelas -->
    <div class="inputContainer">
        <select name="kelas_id" id="kelas_id" required class="customInput">
            <option value="" disabled {{ old('kelas_id', $laprak->kelas_id ?? '') ? '' : 'selected' }}>-- Pilih Kelas --</option>
            @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->id }}" {{ old('kelas_id', $laprak->kelas_id ?? '') == $kelas->id ? 'selected' : '' }}>
                    {{ $kelas->nama_kelas }}
                </option>
            @endforeach
        </select>
        <label for="kelas_id" class="inputLabel">Kelas</label>
        <div class="inputUnderline"></div>
        <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
    </div>

    <!-- Tahun Ajaran -->
    <div class="inputContainer">
        <select name="semester_id" id="semester_id" required class="customInput">
            <option value="" disabled {{ old('semester_id', $laprak->semester_id ?? '') ? '' : 'selected' }}>-- Pilih Tahun Ajaran --</option>
            @foreach ($semesterList as $semester)
                <option value="{{ $semester->id }}" {{ old('semester_id', $laprak->semester_id ?? '') == $semester->id ? 'selected' : '' }}>
                    {{ $semester->tahun_ajar }}
                </option>
            @endforeach
        </select>
        <label for="semester_id" class="inputLabel">Tahun Ajaran</label>
        <div class="inputUnderline"></div>
        <x-input-error :messages="$errors->get('semester_id')" class="mt-2" />
    </div>

    <!-- Upload Laporan -->
    <div class="inputContainer">
        <input type="file" name="laporan_file" id="laporan_file"
               class="customInput @error('laporan_file') border-red-500 @enderror"
               accept=".pdf,.doc,.docx"
               {{ isset($laprak) ? '' : 'required' }} />
        <label for="laporan_file" class="inputLabel">Upload File Laporan (PDF/DOCX)</label>
        @error('laporan_file')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror

        @if(isset($laprak) && $laprak->laporan_file)
            <p class="text-sm text-gray-500 mt-1">
                File sebelumnya:
                <a href="{{ asset('storage/'.$laprak->laporan_file) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
            </p>
        @endif
    </div>

    <!-- Upload Nilai -->
    <div class="inputContainer">
        <input type="file" name="nilai_file" id="nilai_file"
               class="customInput @error('nilai_file') border-red-500 @enderror"
               accept=".xlsx,.xls,.csv"
               {{ isset($laprak) ? '' : 'required' }} />
        <label for="nilai_file" class="inputLabel">Upload File Nilai (Excel)</label>
        @error('nilai_file')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror

        @if(isset($laprak) && $laprak->nilai_file)
            <p class="text-sm text-gray-500 mt-1">
                File sebelumnya:
                <a href="{{ asset('storage/'.$laprak->nilai_file) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
            </p>
        @endif
    </div>

    <!-- Deskripsi -->
    <div class="inputGroup">
        <textarea id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $laprak->deskripsi ?? '') }}</textarea>
        <label for="deskripsi">Catatan / Deskripsi</label>
        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
    </div>

    <!-- Tombol -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t">
        <a href="{{ route('laprak.index') }}"
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-600 shadow-sm hover:bg-gray-50">
            <i class="fa fa-arrow-left mr-2"></i>
            <span>Batal</span>
        </a>

        <button type="submit"
                class="inline-flex items-center px-6 py-2 rounded-lg shadow-sm bg-blue-600 text-white hover:bg-blue-700">
            <i class="fa {{ isset($laprak) ? 'fa-save' : 'fa-paper-plane' }} mr-2"></i>
            <span>{{ isset($laprak) ? 'Update' : 'Simpan' }}</span>
        </button>
    </div>
</form>

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
        border: 2px solid rgb(200, 200, 200);
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
        color: rgb(100, 100, 100);
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
