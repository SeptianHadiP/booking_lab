@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-1">Create User</h2>
            <p class="text-sm text-gray-500">Masukkan data pengguna baru</p>
        </div>
        <a href="{{ route('schedule.index') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">
            Kembali
        </a>
    </div>

    <!-- Form -->
    <form action="#" method="POST" class="space-y-5">
        @csrf

        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" id="name" required placeholder="Masukkan nama lengkap"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>

        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" name="username" id="username" required placeholder="Masukkan username"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" required placeholder="Masukkan email"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" id="password" required placeholder="Masukkan password"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow-sm transition">
            Simpan
        </button>
    </form>
</div>
@endsection
