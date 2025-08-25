@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Edit User</h2>
            <p class="text-muted small mb-0">Perbarui data dan hak akses pengguna</p>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-success">← Kembali</a>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="alert alert-danger small">
            <strong>Oops! Ada kesalahan:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" value="{{ old('name', $user->name) }}" class="form-control" id="name" name="name" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" value="{{ old('email', $user->email) }}" class="form-control" id="email" name="email" required>
        </div>

        <!-- Roles -->
        <div class="mb-4">
            <label class="form-label d-block">Roles</label>
            <div class="row">
                @forelse ($roles as $role)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                class="form-check-input"
                                id="role-{{ $role->id }}"
                                name="roles[]"
                                value="{{ $role->name }}"
                                {{ $hasRoles->contains($role->name) ? 'checked' : '' }}>
                            <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Tidak ada role tersedia.</p>
                @endforelse
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex gap-2">
            <a href="{{ route('users.index') }}" class="btn btn-light border shadow-sm px-3">
                <i class="fa fa-arrow-left me-2 text-secondary"></i>
                <span class="text-secondary fw-semibold">Batal</span>
            </a>

            <button type="submit" class="btn btn-primary shadow-sm px-4">
                <i class="fa fa-save me-2"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
