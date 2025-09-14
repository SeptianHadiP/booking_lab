@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <!-- Header -->
    <div class="flex flex-wrap items-start justify-between gap-2 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Generate Sertifikat</h2>
            <p class="text-sm text-gray-500">Cek informasi laporan praktikum dan pilih template sebelum membuat sertifikat.</p>
        </div>
    </div>

    <form action="{{ route('certificate.store') }}" method="POST">
        @csrf
        <input type="hidden" name="laprak_id" value="{{ $laprak->id }}">
        <input type="hidden" name="user_id" value="{{ $laprak->user->id }}">

        <!-- Info Mahasiswa -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <strong>👨‍🎓 Nama:</strong><br>
                <span class="text-gray-800">{{ $laprak->user->name }}</span>
            </div>
            <div>
                <strong>📚 Mata Kuliah:</strong><br>
                <span class="text-gray-800">{{ $laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? '-' }}</span>
            </div>
            <div>
                <strong>🏫 Kelas:</strong><br>
                <span class="text-gray-800">{{ $laprak->kelas->nama_kelas ?? '-' }}</span>
            </div>
            <div>
                <strong>📅 Tahun Ajaran:</strong><br>
                <span class="text-gray-800">{{ $laprak->semester->tahun_ajar ?? '-' }}</span>
            </div>
            <div class="md:col-span-2">
                <strong>📄 File Nilai:</strong><br>
                <a href="{{ asset('storage/' . $laprak->nilai_file) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Nilai</a>
            </div>
        </div>

        <hr class="my-4">

        <!-- Dropdown Template -->
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Pilih Template Sertifikat</h3>
            <select id="template_id" name="template_id"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
                <option value="">-- Pilih Template --</option>
                @foreach ($templates as $template)
                    <option value="{{ $template->id }}"
                        data-name-x="{{ $template->name_x }}"
                        data-name-y="{{ $template->name_y }}"
                        data-score-x="{{ $template->score_x }}"
                        data-score-y="{{ $template->score_y }}"
                        data-desc-x="{{ $template->desc_x }}"
                        data-desc-y="{{ $template->desc_y }}"
                        data-font-color="{{ $template->font_color }}"
                        data-file-path="{{ asset($template->file_path) }}"
                        {{ old('template_id') == $template->id ? 'selected' : '' }}>
                        {{ $template->name }}
                    </option>
                @endforeach
            </select>
            @error('template_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Preview Info Template -->
        <div id="template-info" class="hidden border p-4 rounded mb-4 bg-gray-50">
            <p><strong>Posisi Nama:</strong> <span id="nameX"></span>, <span id="nameY"></span></p>
            <p><strong>Posisi Nilai:</strong> <span id="scoreX"></span>, <span id="scoreY"></span></p>
            <p><strong>Posisi Deskripsi:</strong> <span id="descX"></span>, <span id="descY"></span></p>
            <p><strong>Font Color:</strong> <span id="fontColor"></span></p>
            <p><strong>File Path:</strong> <a id="filePath" href="#" target="_blank">Lihat File</a></p>
        </div>

        <!-- Tombol -->
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-600 shadow-sm hover:bg-gray-50">
                <i class="fa fa-arrow-left mr-2 text-gray-500"></i> Batal
            </a>

            <button type="submit"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-600 text-white shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Generate Sertifikat
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectTemplate = document.getElementById('template_id');
    const info = document.getElementById('template-info');

    selectTemplate.addEventListener('change', function() {
        if (!this.value) {
            info.classList.add('hidden');
            return;
        }

        const selected = this.options[this.selectedIndex];

        document.getElementById('nameX').textContent = selected.dataset.nameX;
        document.getElementById('nameY').textContent = selected.dataset.nameY;
        document.getElementById('scoreX').textContent = selected.dataset.scoreX;
        document.getElementById('scoreY').textContent = selected.dataset.scoreY;
        document.getElementById('descX').textContent = selected.dataset.descX;
        document.getElementById('descY').textContent = selected.dataset.descY;
        document.getElementById('fontColor').textContent = selected.dataset.fontColor;
        document.getElementById('filePath').href = selected.dataset.filePath;

        info.classList.remove('hidden');
    });

    // 🔔 Notifikasi dari session Laravel
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 2500,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            text: "{{ session('error') }}",
        });
    @endif

    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: "{{ session('warning') }}",
        });
    @endif
});
</script>
@endpush

