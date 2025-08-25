@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Role</h2>

    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">+ Tambah Role</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Role</th>
                <th>Permissions</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @can('edit role')
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        @endcan

                        @can('delete role')
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus role ini?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
