@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Buat Role</h2>
            <p class="text-muted small mb-0">Masukkan informasi role dan hak akses</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger small">
            <strong class="d-block mb-2">Oops! Ada kesalahan:</strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('dashboard.pages.forms.role-form')
</div>
@endsection
