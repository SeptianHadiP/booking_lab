{{-- Nama User (readonly) --}}
<div class="mb-4">
    <label class="block mb-2 font-semibold text-gray-700">Dibuat Oleh</label>
    <input type="text"
           value="{{ auth()->user()->name }}"
           readonly
           class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700">
    {{-- biar user_id tetap terkirim --}}
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
</div>

{{-- Pilih Laporan Praktikum --}}
<div class="mb-4">
    <label class="block mb-2 font-semibold text-gray-700">Pilih Laporan Praktikum *</label>
    <select name="laprak_id"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            required>
        <option value="" disabled selected>-- Pilih Laporan Praktikum --</option>
        @foreach ($laporanPraktikum as $laprak)
            <option value="{{ $laprak->id }}" {{ old('laprak_id') == $laprak->id ? 'selected' : '' }}>
                {{ $laprak->user->name }} - {{ $laprak->mata_kuliah_praktikum->nama ?? 'Tanpa MK' }}
            </option>
        @endforeach
    </select>
    @error('laprak_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Pilih Template --}}
<div class="mb-4">
    <label class="block mb-2 font-semibold text-gray-700">Pilih Template Sertifikat *</label>
    <select name="template_id"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            required>
        <option value="" disabled selected>-- Pilih Template --</option>
        @foreach ($templates as $template)
            <option value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'selected' : '' }}>
                {{ $template->name }}
            </option>
        @endforeach
    </select>
    @error('template_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Submit Button --}}
<div class="mt-6 flex justify-end gap-3">
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-600 shadow-sm hover:bg-gray-50">
        <i class="fa fa-arrow-left mr-2 text-gray-500"></i>
        <span class="font-medium">Batal</span>
    </a>

    <button type="submit"
            class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-600 text-white shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
        Generate Sertifikat
    </button>
</div>
