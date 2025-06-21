@csrf

@if(isset($documentation))
    @method('PUT')
@endif

<input type="hidden" name="scheduling_id" value="{{ old('scheduling_id', $scheduling->id ?? $documentation->scheduling_id ?? '') }}">
<input type="hidden" name="nama" value="{{ auth()->user()->name }}">

<div class="row">
    <div class="col-md-6 mb-3">
        <strong>👨‍🏫 Nama Dosen:</strong><br>
        <span class="text-dark">{{ $scheduling->nama_dosen ?? $documentation->scheduling->nama_dosen ?? '-' }}</span>
    </div>
    <div class="col-md-6 mb-3">
        <strong>📚 Mata Kuliah:</strong><br>
        <span class="text-dark">{{ $scheduling->mata_kuliah ?? $documentation->scheduling->mata_kuliah ?? '-' }}</span>
    </div>
    <div class="col-md-6 mb-3">
        <strong>🏫 Kelas:</strong><br>
        <span class="text-dark">{{ $scheduling->kelas ?? $documentation->scheduling->kelas ?? '-' }}</span>
    </div>
    <div class="col-md-6 mb-3">
        <strong>📅 Tanggal Praktikum:</strong><br>
        <span class="text-dark">
            {{ \Carbon\Carbon::parse($scheduling->tanggal_praktikum ?? $documentation->scheduling->tanggal_praktikum ?? now())->translatedFormat('l, d F Y') }}
        </span>
    </div>
    <div class="col-md-6 mb-3">
        <strong>⏰ Waktu Praktikum:</strong><br>
        <span class="text-dark">{{ $scheduling->waktu_praktikum ?? $documentation->scheduling->waktu_praktikum ?? '-' }}</span>
    </div>
    <div class="col-md-12 mb-3">
        <strong>🛠️ Tools / Software yang Digunakan:</strong><br>
        <span class="text-dark">{{ $scheduling->tools_software ?? $documentation->scheduling->tools_software ?? '-' }}</span>
    </div>
</div>

{{-- Upload Foto Kegiatan 1 --}}
<div class="mb-3">
    <label class="form-label">Upload Foto Kegiatan 1</label>
    <input type="file" class="form-control" name="foto_1" id="foto1" {{ isset($documentation) ? '' : 'required' }}>
    @if(isset($documentation) && $documentation->foto_1)
        <img src="{{ asset('storage/' . $documentation->foto_1) }}" class="mt-2" width="150">
    @endif
</div>

{{-- Upload Foto Kegiatan 2 (initially hidden) --}}
<div class="mb-3 d-none" id="foto2-container">
    <label class="form-label">Upload Foto Kegiatan 2</label>
    <input type="file" class="form-control" name="foto_2" id="foto2">
    @if(isset($documentation) && $documentation->foto_2)
        <img src="{{ asset('storage/' . $documentation->foto_2) }}" class="mt-2" width="150">
    @endif
</div>

{{-- Upload Absensi 1 --}}
<div class="mb-3">
    <label class="form-label">Upload Absensi 1</label>
    <input type="file" class="form-control" name="absen_1" id="absen1">
    @if(isset($documentation) && $documentation->absen_1)
        <img src="{{ asset('storage/' . $documentation->absen_1) }}" class="mt-2" width="150">
    @endif
</div>

{{-- Upload Absensi 2 (initially hidden) --}}
<div class="mb-3 d-none" id="absen2-container">
    <label class="form-label">Upload Absensi 2</label>
    <input type="file" class="form-control" name="absen_2" id="absen2">
    @if(isset($documentation) && $documentation->absen_2)
        <img src="{{ asset('storage/' . $documentation->absen_2) }}" class="mt-2" width="150">
    @endif
</div>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        {{-- Tombol Kembali --}}
        <a href="{{ url()->previous() }}" class="btn btn-light border d-flex align-items-center shadow-sm px-3">
            <i class="fa fa-arrow-left me-2 text-secondary"></i>
            <span class="text-secondary fw-semibold">Batal</span>
        </a>
        
        {{-- Tombol Submit --}}
        <button type="submit" class="btn btn-primary">
            {{ isset($documentation) ? 'Update Dokumentasi' : 'Simpan Dokumentasi' }}
        </button>
</div>



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
                    container.classList.remove('d-none');
                } else {
                    container.classList.add('d-none');
                }
            });

            // Cek jika sebelumnya sudah ada file (dari edit form)
            if (input.files.length > 0) {
                container.classList.remove('d-none');
            }
        }

        toggleNextUpload(foto1, foto2Container);
        toggleNextUpload(absen1, absen2Container);
    });
</script>
@endpush
