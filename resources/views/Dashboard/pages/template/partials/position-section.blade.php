<!-- resources/views/dashboard/pages/template/partials/position-section.blade.php -->
@php
    $xType = old($prefix.'_x_type', $data->{$prefix.'_x_type'} ?? 'center');
    $xValue = old($prefix.'_x', $data->{$prefix.'_x'} ?? '');
    $yType = old($prefix.'_y_type', $data->{$prefix.'_y_type'} ?? 'center');
    $yValue = old($prefix.'_y', $data->{$prefix.'_y'} ?? '');
@endphp

<div class="border rounded p-4 my-4">
    <h5 class="font-semibold mb-3 text-gray-800">{{ $title }}</h5>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block mb-1 text-gray-600">X Type</label>
            <select name="{{ $prefix }}_x_type" class="w-full border rounded px-3 py-2" onchange="toggleInput(this,'{{ $prefix }}_x')">
                <option value="center" {{ $xType === 'center' ? 'selected' : '' }}>Center</option>
                <option value="custom" {{ $xType === 'custom' ? 'selected' : '' }}>Custom</option>
            </select>
            <input type="number" name="{{ $prefix }}_x" id="{{ $prefix }}_x" class="mt-2 w-full border rounded px-3 py-2 {{ $xType === 'custom' ? '' : 'hidden' }}" placeholder="Masukkan nilai X" value="{{ $xValue }}">
        </div>
        <div>
            <label class="block mb-1 text-gray-600">Y Type</label>
            <select name="{{ $prefix }}_y_type" class="w-full border rounded px-3 py-2" onchange="toggleInput(this,'{{ $prefix }}_y')">
                <option value="center" {{ $yType === 'center' ? 'selected' : '' }}>Center</option>
                <option value="custom" {{ $yType === 'custom' ? 'selected' : '' }}>Custom</option>
            </select>
            <input type="number" name="{{ $prefix }}_y" id="{{ $prefix }}_y" class="mt-2 w-full border rounded px-3 py-2 {{ $yType === 'custom' ? '' : 'hidden' }}" placeholder="Masukkan nilai Y" value="{{ $yValue }}">
        </div>
    </div>
</div>
