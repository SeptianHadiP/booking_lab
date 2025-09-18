@extends('dashboard.layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h4 class="text-lg font-semibold text-gray-800 mb-4">Edit Template Sertifikat & Atur Posisi</h4>

    {{-- Alert --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-2 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-2 text-red-700 bg-red-100 rounded">{{ session('error') }}</div>
    @endif

    @php
        // Pastikan warna font valid untuk color input
        $fontColor = old('font_color', $template->font_color ?? '#2D9C63');
        if($fontColor && $fontColor[0] !== '#') $fontColor = '#'.$fontColor;
    @endphp

    <form action="{{ route('template.update', $template->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Inputs --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Nama Template</label>
                <input type="text" name="name" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required value="{{ old('name', $template->name) }}">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Pilih Warna Font (Hanya Nama)</label>
                <input type="color" name="font_color" value="{{ $fontColor }}" class="w-16 h-10 p-0 border rounded">
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-semibold text-gray-700">Upload Background Image (kosong jika tidak diubah)</label>
                <input type="file" name="template_file" accept="image/*" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        {{-- Posisi Sections --}}
        @include('dashboard.pages.template.partials.position-section', ['prefix'=>'name','title'=>'Posisi Nama','data'=>$template])
        @include('dashboard.pages.template.partials.position-section', ['prefix'=>'score','title'=>'Posisi Nilai','data'=>$template])
        @include('dashboard.pages.template.partials.position-section', ['prefix'=>'desc','title'=>'Posisi Deskripsi','data'=>$template])

        {{-- Preview Sertifikat --}}
        <div class="mt-5">
            <h4 class="text-lg font-semibold text-gray-800 mb-3">Preview Sertifikat</h4>
            <div id="preview-area" class="relative w-full max-w-[1123px] h-[794px] border border-gray-300 overflow-hidden">
                <img id="bg-preview" src="{{ asset($template->file_path) }}" class="absolute top-0 left-0 w-full h-full">
                <div id="text-preview-container" class="absolute top-0 left-0 w-full h-full pointer-events-none">
                    <div id="preview-name" class="absolute font-bold">Nama Kamu</div>
                    <div id="preview-score" class="absolute">Nilai Kamu</div>
                    <div id="preview-desc" class="absolute text-sm">Deskripsi Kamu</div>
                </div>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="mt-4 flex justify-between">
            <a href="{{ route('template.index') }}" class="px-5 py-2 bg-gray-300 text-gray-800 font-bold rounded hover:bg-gray-400 transition">
                Kembali
            </a>
            <button type="submit" class="px-5 py-2 bg-green-600 text-white font-bold rounded hover:bg-green-700 transition">
                Update Template
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function toggleInput(select, inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    input.classList.toggle('hidden', select.value !== 'custom');
    updatePreviewPosition();
}

document.addEventListener("DOMContentLoaded", function () {
    const colorPicker = document.querySelector('input[name="font_color"]');
    const fileInput = document.querySelector('input[name="template_file"]');

    // Load warna font lama ke preview saat load
    if(colorPicker){
        const nameEl = document.getElementById('preview-name');
        if(nameEl) nameEl.style.color = colorPicker.value;

        colorPicker.addEventListener('input', () => {
            if(nameEl) nameEl.style.color = colorPicker.value;
        });
    }

    // Preview background live
    if(fileInput){
        fileInput.addEventListener('change', function(e){
            const file = e.target.files[0];
            if(file){
                const reader = new FileReader();
                reader.onload = function(evt){
                    const img = document.getElementById('bg-preview');
                    img.src = evt.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Event listener untuk posisi
    document.addEventListener('input', e => {
        if(e.target.matches('input[name$="_x"], input[name$="_y"]')) updatePreviewPosition();
    });
    document.addEventListener('change', e => {
        if(e.target.matches('select[name$="_x_type"], select[name$="_y_type"]')){
            toggleInput(e.target, e.target.name.replace('_type',''));
            updatePreviewPosition();
        }
    });

    // Set font size preview
    const sizes = {'preview-name':40,'preview-score':30,'preview-desc':20};
    Object.keys(sizes).forEach(id=>{
        const el = document.getElementById(id);
        if(el){ el.style.fontSize = sizes[id]+'px'; el.style.fontWeight='bold'; }
    });

    // Fungsi set posisi
    function setPositionAndTransform(el, xType, xVal, yType, yVal){
        if(!el) return;
        el.style.left = xType==='center' ? '50%' : (parseInt(xVal)||0)+'px';
        el.style.top = yType==='center' ? '50%' : (parseInt(yVal)||0)+'px';
        el.style.transform = (xType==='center'||yType==='center') ? 'translate(-50%, -50%)' : 'none';
    }

    // Fungsi update preview
    window.updatePreviewPosition = function(){
        ['name','score','desc'].forEach(prefix=>{
            const xTypeEl = document.querySelector(`[name="${prefix}_x_type"]`);
            const yTypeEl = document.querySelector(`[name="${prefix}_y_type"]`);
            const xEl = document.querySelector(`[name="${prefix}_x"]`);
            const yEl = document.querySelector(`[name="${prefix}_y"]`);
            const previewEl = document.getElementById(`preview-${prefix}`);
            if(!xTypeEl || !yTypeEl || !xEl || !yEl || !previewEl) return;

            setPositionAndTransform(previewEl, xTypeEl.value, xEl.value, yTypeEl.value, yEl.value);
        });
    };

    // Jalankan saat load untuk posisi awal
    updatePreviewPosition();
});
</script>
@endpush
