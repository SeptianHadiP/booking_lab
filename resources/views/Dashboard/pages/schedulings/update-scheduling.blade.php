@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
        <div>
            <a href="{{ route('schedulings.index') }}" class="btn btn-outline-secondary mb-2">
                <i class="fa fa-arrow-left me-1"></i> Kembali
            </a>
            <h2 class="h4 fw-semibold text-dark mb-1">Edit Jadwal</h2>
            <p class="text-muted small mb-0">Perbarui jadwal praktikum yang telah dibuat</p>
        </div>
    </div>

    @include('dashboard.pages.form.schedulings-form', ['schedule' => $schedule])
</div>
@endsection