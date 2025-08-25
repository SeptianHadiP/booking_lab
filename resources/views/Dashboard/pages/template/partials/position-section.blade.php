@php
    $xType = old($prefix.'_x_type', $data->{$prefix.'_x_type'} ?? 'center');
    $xValue = old($prefix.'_x', $data->{$prefix.'_x'} ?? '');
    $yType = old($prefix.'_y_type', $data->{$prefix.'_y_type'} ?? 'center');
    $yValue = old($prefix.'_y', $data->{$prefix.'_y'} ?? '');
@endphp

<div class="border rounded p-3 my-4">
    <h5 class="fw-bold mb-3">{{ $title }}</h5>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">X Type</label>
            <select name="{{ $prefix }}_x_type" class="form-select" onchange="toggleInput(this, '{{ $prefix }}_x')">
                <option value="center" {{ $xType === 'center' ? 'selected' : '' }}>Center</option>
                <option value="custom" {{ $xType === 'custom' ? 'selected' : '' }}>Custom</option>
            </select>
            <input type="number" name="{{ $prefix }}_x" id="{{ $prefix }}_x" class="form-control mt-2 {{ $xType === 'custom' ? '' : 'd-none' }}" placeholder="Masukkan nilai X" value="{{ $xValue }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Y Type</label>
            <select name="{{ $prefix }}_y_type" class="form-select" onchange="toggleInput(this, '{{ $prefix }}_y')">
                <option value="center" {{ $yType === 'center' ? 'selected' : '' }}>Center</option>
                <option value="custom" {{ $yType === 'custom' ? 'selected' : '' }}>Custom</option>
            </select>
            <input type="number" name="{{ $prefix }}_y" id="{{ $prefix }}_y" class="form-control mt-2 {{ $yType === 'custom' ? '' : 'd-none' }}" placeholder="Masukkan nilai Y" value="{{ $yValue }}">
        </div>
    </div>
</div>

