@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="bg-white shadow-sm rounded p-4">
        <h4 class="fw-bold mb-4 text-dark">Edit Template Sertifikat & Atur Posisi</h4>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('template.update', $template->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                {{-- Nama Template --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Template</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $template->name) }}">
                </div>

                {{-- Warna Font --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold d-block">Pilih Warna Font</label>
                    <input type="color" name="font_color" class="form-control form-control-color" style="width: 60px; height: 40px;"
                        value="{{ old('font_color', $template->font_color ?? '#2D9C63') }}">
                </div>

                {{-- Upload Background --}}
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Upload Background Image (biarkan kosong jika tidak diubah)</label>
                    <input type="file" name="template_file" accept="image/*" class="form-control">
                </div>
            </div>

            {{-- Posisi Nama --}}
            <div class="border rounded p-3 my-4">
                <h5 class="fw-bold mb-3">Posisi Nama</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">X Type</label>
                        <select name="name_x_type" class="form-select" onchange="toggleInput(this, 'name_x')">
                            <option value="center" {{ (old('name_x_type', $template->name_x_type) == 'center') ? 'selected' : '' }}>Center</option>
                            <option value="custom" {{ (old('name_x_type', $template->name_x_type) == 'custom') ? 'selected' : '' }}>Custom</option>
                        </select>
                        <input type="number" name="name_x" id="name_x" class="form-control mt-2 {{ (old('name_x_type', $template->name_x_type) == 'custom') ? '' : 'd-none' }}"
                            placeholder="Masukkan nilai X" value="{{ old('name_x', $template->name_x) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Y Type</label>
                        <select name="name_y_type" class="form-select" onchange="toggleInput(this, 'name_y')">
                            <option value="center" {{ (old('name_y_type', $template->name_y_type) == 'center') ? 'selected' : '' }}>Center</option>
                            <option value="custom" {{ (old('name_y_type', $template->name_y_type) == 'custom') ? 'selected' : '' }}>Custom</option>
                        </select>
                        <input type="number" name="name_y" id="name_y" class="form-control mt-2 {{ (old('name_y_type', $template->name_y_type) == 'custom') ? '' : 'd-none' }}"
                            placeholder="Masukkan nilai Y" value="{{ old('name_y', $template->name_y) }}">
                    </div>
                </div>
            </div>

            {{-- Posisi Nilai --}}
            <div class="border rounded p-3 my-4">
                <h5 class="fw-bold mb-3">Posisi Nilai</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">X Type</label>
                        <select name="score_x_type" class="form-select" onchange="toggleInput(this, 'score_x')">
                            <option value="center" {{ (old('score_x_type', $template->score_x_type) == 'center') ? 'selected' : '' }}>Center</option>
                            <option value="custom" {{ (old('score_x_type', $template->score_x_type) == 'custom') ? 'selected' : '' }}>Custom</option>
                        </select>
                        <input type="number" name="score_x" id="score_x" class="form-control mt-2 {{ (old('score_x_type', $template->score_x_type) == 'custom') ? '' : 'd-none' }}"
                            placeholder="Masukkan nilai X" value="{{ old('score_x', $template->score_x) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Y Type</label>
                        <select name="score_y_type" class="form-select" onchange="toggleInput(this, 'score_y')">
                            <option value="center" {{ (old('score_y_type', $template->score_y_type) == 'center') ? 'selected' : '' }}>Center</option>
                            <option value="custom" {{ (old('score_y_type', $template->score_y_type) == 'custom') ? 'selected' : '' }}>Custom</option>
                        </select>
                        <input type="number" name="score_y" id="score_y" class="form-control mt-2 {{ (old('score_y_type', $template->score_y_type) == 'custom') ? '' : 'd-none' }}"
                            placeholder="Masukkan nilai Y" value="{{ old('score_y', $template->score_y) }}">
                    </div>
                </div>
            </div>

            {{-- Posisi Deskripsi --}}
            <div class="border rounded p-3 my-4">
                <h5 class="fw-bold mb-3">Posisi Deskripsi</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">X Type</label>
                        <select name="desc_x_type" class="form-select" onchange="toggleInput(this, 'desc_x')">
                            <option value="center" {{ (old('desc_x_type', $template->desc_x_type) == 'center') ? 'selected' : '' }}>Center</option>
                            <option value="custom" {{ (old('desc_x_type', $template->desc_x_type) == 'custom') ? 'selected' : '' }}>Custom</option>
                        </select>
                        <input type="number" name="desc_x" id="desc_x" class="form-control mt-2 {{ (old('desc_x_type', $template->desc_x_type) == 'custom') ? '' : 'd-none' }}"
                            placeholder="Masukkan nilai X" value="{{ old('desc_x', $template->desc_x) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Y Type</label>
                        <select name="desc_y_type" class="form-select" onchange="toggleInput(this, 'desc_y')">
                            <option value="center" {{ (old('desc_y_type', $template->desc_y_type) == 'center') ? 'selected' : '' }}>Center</option>
                            <option value="custom" {{ (old('desc_y_type', $template->desc_y_type) == 'custom') ? 'selected' : '' }}>Custom</option>
                        </select>
                        <input type="number" name="desc_y" id="desc_y" class="form-control mt-2 {{ (old('desc_y_type', $template->desc_y_type) == 'custom') ? '' : 'd-none' }}"
                            placeholder="Masukkan nilai Y" value="{{ old('desc_y', $template->desc_y) }}">
                    </div>
                </div>
            </div>

            {{-- Preview Sertifikat --}}
            <div class="mt-5">
                <h4 class="fw-bold mb-3 text-dark">Preview Sertifikat</h4>
                <div id="preview-area" class="position-relative" style="width: 1123px; height: 794px; border: 1px solid #ccc; overflow: hidden;">
                    <img id="bg-preview" src="{{ asset( $template->file_path) }}" alt="Preview Background" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0;">
                    <div id="text-preview-container" class="position-absolute top-0 start-0 w-100 h-100" style="pointer-events: none;">
                        <div id="preview-name" style="position: absolute; font-weight: bold;">Nama Kamu</div>
                        <div id="preview-score" style="position: absolute;">Nilai Kamu</div>
                        <div id="preview-desc" style="position: absolute; font-size: 0.9rem;">Deskripsi Kamu</div>
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success px-5 fw-bold">
                    Update Template
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
    function toggleInput(select, inputId) {
        const input = document.getElementById(inputId);
        if (!input) return;
        input.classList.toggle('d-none', select.value !== 'custom');
        updatePreviewPosition();
    }

    document.addEventListener("DOMContentLoaded", function () {
        const colorPicker = document.querySelector('input[name="font_color"]');
        colorPicker.addEventListener('input', updatePreviewColor);

        const fileInput = document.querySelector('input[name="file_path"]');
        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (evt) {
                    const img = document.getElementById('bg-preview');
                    img.src = evt.target.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        const selects = document.querySelectorAll('select[name$="_x_type"], select[name$="_y_type"]');
        selects.forEach(select => select.addEventListener('change', updatePreviewPosition));

        const inputs = document.querySelectorAll('input[name$="_x"], input[name$="_y"]');
        inputs.forEach(input => input.addEventListener('input', updatePreviewPosition));

        function updatePreviewStyle() {
            const name = document.getElementById('preview-name');
            const score = document.getElementById('preview-score');
            const desc = document.getElementById('preview-desc');

            name.style.fontSize = '40px';
            name.style.fontWeight = 'bold';

            score.style.fontSize = '30px';
            score.style.fontWeight = 'bold';

            desc.style.fontSize = '20px';
            desc.style.fontWeight = 'bold';
        }

        function updatePreviewColor() {
            const color = colorPicker.value;
            document.getElementById('preview-name').style.color = color;
            document.getElementById('preview-score').style.color = color;
            document.getElementById('preview-desc').style.color = color;
        }

        function getPosition(type, value, totalSize) {
            if (type === 'center') return (totalSize / 2) + 'px';
            return parseInt(value || 0) + 'px';
        }

        function updatePreviewPosition() {
            const previewWidth = 1123;
            const previewHeight = 794;

            const nameXType = document.querySelector('[name="name_x_type"]').value;
            const nameYType = document.querySelector('[name="name_y_type"]').value;
            const nameX = document.querySelector('[name="name_x"]').value;
            const nameY = document.querySelector('[name="name_y"]').value;

            const scoreXType = document.querySelector('[name="score_x_type"]').value;
            const scoreYType = document.querySelector('[name="score_y_type"]').value;
            const scoreX = document.querySelector('[name="score_x"]').value;
            const scoreY = document.querySelector('[name="score_y"]').value;

            const descXType = document.querySelector('[name="desc_x_type"]').value;
            const descYType = document.querySelector('[name="desc_y_type"]').value;
            const descX = document.querySelector('[name="desc_x"]').value;
            const descY = document.querySelector('[name="desc_y"]').value;

            const previewName = document.getElementById('preview-name');
            const previewScore = document.getElementById('preview-score');
            const previewDesc = document.getElementById('preview-desc');

            previewName.style.left = getPosition(nameXType, nameX, previewWidth);
            previewName.style.top = getPosition(nameYType, nameY, previewHeight);
            previewName.style.transform = (nameXType === 'center' || nameYType === 'center') ? 'translate(-50%, -50%)' : 'none';

            previewScore.style.left = getPosition(scoreXType, scoreX, previewWidth);
            previewScore.style.top = getPosition(scoreYType, scoreY, previewHeight);
            previewScore.style.transform = (scoreXType === 'center' || scoreYType === 'center') ? 'translate(-50%, -50%)' : 'none';

            previewDesc.style.left = getPosition(descXType, descX, previewWidth);
            previewDesc.style.top = getPosition(descYType, descY, previewHeight);
            previewDesc.style.transform = (descXType === 'center' || descYType === 'center') ? 'translate(-50%, -50%)' : 'none';
        }

        // Initialize preview based on existing data
        updatePreviewColor();
        updatePreviewPosition();
        updatePreviewStyle();
    });
</script>
