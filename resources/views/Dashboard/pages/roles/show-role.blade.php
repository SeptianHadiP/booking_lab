@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">

    <div class="d-flex justify-between align-items-center mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Detail Role</h2>
            <p class="text-muted small mb-0">Lihat detail informasi role dan hak akses</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>

    <div class="mb-4">
        <label class="form-label fw-bold">Nama Role</label>
        <div class="form-control-plaintext">{{ $role->name }}</div>
    </div>

    <div class="mb-4">
        <label class="form-label fw-bold">Hak Akses (Permissions)</label>
        <div class="d-flex flex-wrap gap-2">
            @if($role->permissions->isNotEmpty())
                @foreach ($role->permissions as $permission)
                    <span class="badge bg-primary text-white">
                        <i class="fa fa-check me-1"></i> {{ $permission->name }}
                    </span>
                @endforeach
            @else
                <span class="text-muted">Tidak ada permissions yang diberikan.</span>
            @endif
        </div>
    </div>

    <hr>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning text-white rounded-pill">
            <i class="fa fa-pencil"></i> Edit
        </a>
        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus role ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger rounded-pill">
                <i class="fa fa-trash"></i> Hapus
            </button>
        </form>
    </div>

</div>
@endsection
