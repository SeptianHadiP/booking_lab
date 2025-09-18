@extends('landing.layout')

@section('content')
<section id="sertifikat" class="py-16 bg-gray-50" x-data="sertifikatFilter()">
  <div class="container mx-auto px-4 mt-20">
    <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">📜 Daftar Sertifikat</h2>

    {{-- Filter Form --}}
    <form action="{{ route('sertifikat.filter') }}" method="GET" class="flex flex-wrap justify-center gap-4 mb-8">

      {{-- Dropdown Tahun --}}
      <select x-model="tahun" name="tahun"
        class="border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">-- Pilih Tahun Ajaran --</option>
        @foreach($tahunAjar as $t)
          <option value="{{ $t }}">{{ $t }}</option>
        @endforeach
      </select>

      {{-- Dropdown Mata Kuliah --}}
      <template x-if="tahun">
        <select x-model="matkul" name="matkul"
          class="border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">-- Pilih Mata Kuliah --</option>
          <template x-for="mk in matkuls[tahun]" :key="mk">
            <option :value="mk" x-text="mk"></option>
          </template>
        </select>
      </template>

      {{-- Dropdown Kelas --}}
      <template x-if="tahun && matkul">
        <select name="kelas"
          class="border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">-- Pilih Kelas --</option>
          <template x-for="kls in kelasList[tahun][matkul]" :key="kls">
            <option :value="kls" x-text="kls"></option>
          </template>
        </select>
      </template>

      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow transition">
        Cari
      </button>
    </form>

    {{-- Sertifikat List --}}
    @if(isset($files) && count($files) > 0)
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($files as $file)
          <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center hover:shadow-lg transition">
            <span class="text-gray-700 truncate">{{ basename($file) }}</span>
            <a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-blue-600 hover:underline font-medium">Lihat</a>
          </div>
        @endforeach
      </div>
    @elseif(request()->all())
      <p class="text-center text-gray-500 text-lg mt-6">❌ Tidak ada sertifikat ditemukan.</p>
    @endif
  </div>
</section>

<script>
function sertifikatFilter() {
  return {
    tahun: "{{ request('tahun') ?? '' }}",
    matkul: "{{ request('matkul') ?? '' }}",
    matkuls: @json($matkulsByTahun ?? []),
    kelasList: @json($kelasByMatkul ?? []),
  }
}
</script>
@endsection
