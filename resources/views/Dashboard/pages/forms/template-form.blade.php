<form
    action="{{ $formAction ?? route('template.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @if(isset($template))
        @method('PUT')
    @endif

    <div class="row g-4">
        {{-- Nama Template --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Template</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $template->name ?? '') }}"
                required
            >
        </div>

        {{-- Warna Font --}}
        <div class="col-md-6 text-center">
            <label class="form-label fw-semibold d-block">Pilih Warna Font</label>
            <input
                type="color"
                name="font_color"
                value="{{ old('font_color', $template->font_color ?? '#2D9C63') }}"
                class="form-control form-control-color mx-auto"
                style="width: 60px; height: 40px;"
            >
        </div>

        {{-- Upload Background --}}
        <div class="col-md-12">
            <label class="form-label fw-semibold">Upload Background Image</label>
            <input
                type="file"
                name="template_file"
                accept="image/*"
                class="form-control"
                {{ isset($template) ? '' : 'required' }}
            >
            @if(isset($template->file_path))
                <div class="mt-2 text-center">
                    <img
                        src="{{ asset($template->file_path) }}"
                        alt="Preview"
                        style="max-width: 150px; height: auto;"
                    >
                </div>
            @endif
        </div>
    </div>

    {{-- Posisi Nama --}}
    @include('dashboard.pages.template.partials.position-section', [
        'title' => 'Posisi Nama',
        'prefix' => 'name',
        'data' => $template ?? null
    ])

    {{-- Posisi Nilai --}}
    @include('dashboard.pages.template.partials.position-section', [
        'title' => 'Posisi Nilai',
        'prefix' => 'score',
        'data' => $template ?? null
    ])

    {{-- Posisi Deskripsi --}}
    @include('dashboard.pages.template.partials.position-section', [
        'title' => 'Posisi Deskripsi',
        'prefix' => 'desc',
        'data' => $template ?? null
    ])

    {{-- Preview Sertifikat --}}
    <div class="mt-5">
        <h4 class="fw-bold mb-3 text-dark">Preview Sertifikat</h4>
        <div
            id="preview-area"
            class="position-relative"
            style="width: 1123px; height: 794px; border: 1px solid #ccc; overflow: hidden;"
        >
            <img
                id="bg-preview"
                src="{{ isset($template->file_path) ? asset($template->file_path) : '' }}"
                alt="Preview Background"
                style="
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                    position: absolute;
                    top: 0;
                    left: 0;
                    {{ isset($template->file_path) ? '' : 'display: none;' }}
                "
            >

            <div
                id="text-preview-container"
                class="position-absolute top-0 start-0 w-100 h-100"
                style="pointer-events: none;"
            >
                <div id="preview-name" style="position: absolute; font-weight: bold;">
                    Nama Kamu
                </div>
                <div id="preview-score" style="position: absolute;">
                    Nilai Kamu
                </div>
                <div id="preview-desc" style="position: absolute; font-size: 0.9rem;">
                    Deskripsi Kamu
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Simpan --}}
    <div class="text-end mt-4">
        <button type="submit" class="btn btn-success px-5 fw-bold">
            Simpan Template
        </button>
    </div>
</form>
