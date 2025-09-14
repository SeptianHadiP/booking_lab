@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-1">Detail Role</h2>
            <p class="text-sm text-gray-500">Lihat detail informasi role dan hak akses</p>
        </div>
        <a href="{{ route('roles.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded transition">
            ← Kembali
        </a>
    </div>

    <!-- Nama Role -->
    <div class="mb-6">
        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Role</label>
        <div class="text-gray-800">{{ $role->name }}</div>
    </div>

    <!-- Permissions -->
    <div class="mb-6">
        <label class="block text-sm font-bold text-gray-700 mb-2">Hak Akses (Permissions)</label>
        <div class="flex flex-wrap gap-2">
            @if($role->permissions->isNotEmpty())
                @foreach ($role->permissions as $permission),
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-600 text-white text-sm">
                        <i class="fa fa-check mr-1"></i> {{ $permission->name }}
                    </span>
                @endforeach
            @else
                <span class="text-gray-400 text-sm">Tidak ada permissions yang diberikan.</span>
            @endif
        </div>
    </div>

    <hr class="my-6 border-gray-200">

    <!-- Actions -->
    <div class="flex flex-wrap justify-end gap-3">
        <a href="{{ route('roles.edit', $role->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded-full transition">
            <i class="fa fa-pencil"></i> Edit
        </a>
        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus role ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-full transition">
                <i class="fa fa-trash"></i> Hapus
            </button>
        </form>
    </div>

</div>
@endsection
