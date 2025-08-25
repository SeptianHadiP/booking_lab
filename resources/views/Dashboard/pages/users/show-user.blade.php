@extends('dashboard.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">
                <i class="fa fa-user-circle"></i> Informasi Pengguna
            </h5>
        </div>

        <div class="card-body p-4" style="font-size: 16px;">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>👤 Nama Lengkap:</strong><br>
                    <span class="text-dark">{{ $user->name }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>📧 Email:</strong><br>
                    <span class="text-dark">{{ $user->email }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>🔐 Roles:</strong><br>
                    @if($user->roles->isNotEmpty())
                        @foreach($user->roles as $role)
                            <span class="badge bg-primary">{{ $role->name }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">Belum memiliki role</span>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <strong>🕓 Dibuat Pada:</strong><br>
                    <span class="text-dark">{{ $user->created_at->format('d F Y, H:i') }}</span>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-light border rounded-pill">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning text-white rounded-pill">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
