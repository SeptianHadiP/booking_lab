@props(['type' => 'success', 'message' => ''])

@php
    $colors = [
        'success' => 'bg-success text-white',
        'error' => 'bg-danger text-white',
        'warning' => 'bg-warning text-dark',
        'info' => 'bg-info text-dark',
    ];
    $icons = [
        'success' => 'fa-check-circle',
        'error' => 'fa-times-circle',
        'warning' => 'fa-exclamation-triangle',
        'info' => 'fa-info-circle',
    ];
@endphp

<div class="position-fixed top-0 end-0 p-3 z-1055" style="z-index: 1080;">
    <div id="alert-toast" class="toast align-items-center {{ $colors[$type] }} border-0 show shadow"
        role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa {{ $icons[$type] }} me-2"></i> {{ $message }}
            </div>
            <button type="button" class="btn-close {{ $type === 'success' ? 'btn-close-white' : '' }} me-2 m-auto"
                data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
