<!-- resources/views/admin/users/create.blade.php -->
@extends('dashboard.layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="bg-white shadow-md rounded-xl p-8 border border-gray-100">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Tambah User</h2>
            <a href="{{ route('users.index') }}"
               class="text-sm font-medium text-indigo-600 hover:text-indigo-700 flex items-center">
                <span class="mr-1">←</span> Kembali
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Masukkan nama" required
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" />
                @error('name') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                <input id="username" name="username" type="text" value="{{ old('username') }}" placeholder="Masukkan username" required
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" />
                @error('username') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Masukkan email" required
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" />
                @error('email') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Pilih Role</label>
                <select id="role" name="role" required
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm
                        focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition bg-white">
                    <option value="">-- Pilih Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Password & Konfirmasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" placeholder="••••••••" required
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" />
                    @error('password') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" required
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" />
                    @error('password_confirmation') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Action -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-50 transition">Kembali</a>
                <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 rounded-lg font-semibold text-white shadow
                               hover:bg-indigo-700 focus:outline-none focus:ring-2
                               focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
