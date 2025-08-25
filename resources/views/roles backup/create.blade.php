@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Role Baru</h2>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Role</label>
            <input type="text" name="name" class="form-control" placeholder="Contoh: kalab" required>
        </div>

        <div class="mb-3">
            <label for="permissions" class="form-label">Pilih Permission</label><br>
            @foreach($permissions as $permission)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" id="perm_{{ $permission->id }}">
                    <label class="form-check-label" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
