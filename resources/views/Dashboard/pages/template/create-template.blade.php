<!-- resources/views/dashboard/pages/template/create-template.blade.php -->
@extends('dashboard.layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h4 class="text-lg font-semibold text-gray-800 mb-4">Upload Template Sertifikat & Atur Posisi</h4>

    {{-- Alert --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-2 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-2 text-red-700 bg-red-100 rounded">{{ session('error') }}</div>
    @endif

    <form action="{{ route('template.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Form Inputs --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Nama Template --}}
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Nama Template</label>
                <input type="text" name="name" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            {{-- Warna Font --}}
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Pilih Warna Font</label>
                <input type="color" name="font_color" value="#2D9C63" class="w-16 h-10 p-0 border rounded">
            </div>

            {{-- Upload Background --}}
            <div class="md:col-span-2">
                <label class="block mb-1 font-semibold text-gray-700">Upload Background Image</label>
                <input type="file" name="template_file" accept="image/*" class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        {{-- Posisi Nama --}}
        @include('dashboard.pages.template.partials.position-section', ['title'=>'Posisi Nama','prefix'=>'name','data'=>null])

        {{-- Posisi Nilai --}}
        @include('dashboard.pages.template.partials.position-section', ['title'=>'Posisi Nilai','prefix'=>'score','data'=>null])

        {{-- Posisi Deskripsi --}}
        @include('dashboard.pages.template.partials.position-section', ['title'=>'Posisi Deskripsi','prefix'=>'desc','data'=>null])

        {{-- Preview Sertifikat --}}
        <div class="mt-5">
            <h4 class="text-lg font-semibold text-gray-800 mb-3">Preview Sertifikat</h4>
            <div id="preview-area" class="relative w-full max-w-[1123px] h-[794px] border border-gray-300 overflow-hidden">
                <img id="bg-preview" src="" alt="Preview Background" class="absolute top-0 left-0 w-full h-full hidden z-0">
                <div id="text-preview-container" class="absolute top-0 left-0 w-full h-full pointer-events-none z-10">
                    <div id="preview-name" class="absolute font-bold">Nama Kamu</div>
                    <div id="preview-score" class="absolute">Nilai Kamu</div>
                    <div id="preview-desc" class="absolute text-sm">Deskripsi Kamu</div>
                </div>
            </div>
        </div>

        {{-- Tombol Kembali & Simpan --}}
        <div class="mt-4 flex justify-between">
            <a href="{{ route('template.index') }}" class="px-5 py-2 bg-gray-300 text-gray-800 font-bold rounded hover:bg-gray-400 transition">
                Kembali
            </a>
            <button type="submit" class="px-5 py-2 bg-green-600 text-white font-bold rounded hover:bg-green-700 transition">
                Simpan Template
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
@include('dashboard.pages.template.partials.script')
@endpush
