@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-1">Edit User</h2>
            <p class="text-sm text-gray-500">Perbarui data dan hak akses pengguna</p>
        </div>
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">
            ← Kembali
        </a>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
            <strong>Oops! Ada kesalahan:</strong>
            <ul class="mt-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" id="name" required
                value="{{ old('name', $user->name) }}"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" required
                value="{{ old('email', $user->email) }}"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
        </div>

        <!-- Roles -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Roles</label>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                @forelse ($roles as $role)
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox"
                            name="roles[]"
                            value="{{ $role->name }}"
                            id="role-{{ $role->id }}"
                            {{ $hasRoles->contains($role->name) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-200">
                        <span class="text-gray-700">{{ $role->name }}</span>
                    </label>
                @empty
                    <p class="text-gray-400 text-sm">Tidak ada role tersedia.</p>
                @endforelse
            </div>
        </div>

        <!-- Tombol -->
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('users.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-100 border text-gray-700 rounded shadow-sm hover:bg-gray-200 transition">
                <i class="fa fa-arrow-left"></i> Batal
            </a>
            <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow-sm transition">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
