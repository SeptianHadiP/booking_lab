<!-- resources/views/dashboard/pages/forms/documentation-form.blade.php -->
<form action="{{ isset($documentation) ? route('documentations.update', $documentation->id) : route('documentations.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($documentation))
        @method('PUT')
    @endif

    <input type="hidden" name="scheduling_id" value="{{ old('scheduling_id', $scheduling->id ?? $documentation->scheduling_id ?? '') }}">
    <input type="hidden" name="nama" value="{{ auth()->user()->name }}">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <strong>👨‍🏫 Nama Dosen:</strong><br>
            <span class="text-gray-800">{{ $scheduling->user->name ?? $documentation->scheduling->user->name ?? '-' }}</span>
        </div>
        <div>
            <strong>📚 Mata Kuliah:</strong><br>
            <span class="text-gray-800">
                {{ $scheduling->mata_kuliah_praktikum->nama_mata_kuliah ?? $documentation->scheduling->mata_kuliah_praktikum->nama_mata_kuliah ?? '-' }}
            </span>
        </div>
        <div>
            <strong>🏫 Kelas:</strong><br>
            <span class="text-gray-800">{{ $scheduling->kelas->nama_kelas ?? $documentation->scheduling->kelas->nama_kelas ?? '-' }}</span>
        </div>
        <div>
            <strong>🏢 Tempat / Lab Praktikum:</strong><br>
            <span class="text-gray-800">{{ $scheduling->laboratorium->nama_ruangan ?? $documentation->scheduling->laboratorium->nama_ruangan ?? '-' }}</span>
        </div>
        <div>
            <strong>📅 Tanggal Praktikum:</strong><br>
            <span class="text-gray-800">
                {{ \Carbon\Carbon::parse($scheduling->tanggal_praktikum ?? $documentation->scheduling->tanggal_praktikum ?? now())->translatedFormat('l, d F Y') }}
            </span>
        </div>
        <div>
            <strong>⏰ Waktu Praktikum:</strong><br>
            <span class="text-gray-800">{{ $scheduling->waktu_praktikum ?? $documentation->scheduling->waktu_praktikum ?? '-' }}</span>
        </div>
        <div class="md:col-span-2">
            <strong>🛠️ Tools / Software yang Digunakan:</strong><br>
            <span class="text-gray-800">{{ $scheduling->deskripsi ?? $documentation->scheduling->deskripsi ?? '-' }}</span>
        </div>
    </div>

    {{-- Upload Foto Kegiatan 1 --}}
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Upload Foto Kegiatan 1 *</label>
        <input type="file" name="foto_1" id="foto1"
               class="mt-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
               {{ isset($documentation) ? '' : 'required' }}>
        @error('foto_1')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @if(isset($documentation) && $documentation->foto_1)
            <img src="{{ asset('storage/' . $documentation->foto_1) }}" class="mt-2 w-36 rounded" alt="Foto 1">
        @endif
    </div>

    {{-- Upload Foto Kegiatan 2 --}}
    <div class="mt-4 {{ isset($documentation->foto_2) ? '' : 'hidden' }}" id="foto2-container">
        <label class="block text-sm font-medium text-gray-700">Upload Foto Kegiatan 2</label>
        <input type="file" name="foto_2" id="foto2"
               class="mt-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('foto_2')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @if(isset($documentation) && $documentation->foto_2)
            <img src="{{ asset('storage/' . $documentation->foto_2) }}" class="mt-2 w-36 rounded" alt="Foto 2">
        @endif
    </div>

    {{-- Upload Absensi 1 --}}
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Upload Absensi 1 *</label>
        <input type="file" name="absen_1" id="absen1"
               class="mt-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
               {{ isset($documentation) ? '' : 'required' }}>
        @error('absen_1')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @if(isset($documentation) && $documentation->absen_1)
            <img src="{{ asset('storage/' . $documentation->absen_1) }}" class="mt-2 w-36 rounded" alt="Absensi 1">
        @endif
    </div>

    {{-- Upload Absensi 2 --}}
    <div class="mt-4 {{ isset($documentation->absen_2) ? '' : 'hidden' }}" id="absen2-container">
        <label class="block text-sm font-medium text-gray-700">Upload Absensi 2</label>
        <input type="file" name="absen_2" id="absen2"
               class="mt-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('absen_2')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @if(isset($documentation) && $documentation->absen_2)
            <img src="{{ asset('storage/' . $documentation->absen_2) }}" class="mt-2 w-36 rounded" alt="Absensi 2">
        @endif
    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-6 flex flex-wrap gap-3 items-center justify-between">
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-600 shadow-sm hover:bg-gray-50">
            <i class="fa fa-arrow-left mr-2 text-gray-500"></i>
            <span class="font-medium">Batal</span>
        </a>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-600 text-white shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
            {{ isset($documentation) ? 'Update Dokumentasi' : 'Simpan Dokumentasi' }}
        </button>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const foto1 = document.getElementById('foto1');
    const foto2Container = document.getElementById('foto2-container');

    const absen1 = document.getElementById('absen1');
    const absen2Container = document.getElementById('absen2-container');

    function toggleNextUpload(input, container) {
        input.addEventListener('change', function () {
            if (this.files.length > 0) {
                container.classList.remove('hidden');
            } else if (!container.querySelector('img')) {
                // jika tidak ada gambar sebelumnya, sembunyikan
                container.classList.add('hidden');
            }
        });

        // tampilkan jika edit sudah ada file
        if (container.querySelector('img')) {
            container.classList.remove('hidden');
        }
    }

    toggleNextUpload(foto1, foto2Container);
    toggleNextUpload(absen1, absen2Container);
});
</script>
@endpush
