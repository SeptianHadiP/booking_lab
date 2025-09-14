<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lab Schedule FIKOM UBHARA</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gray-100">

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    <!-- Kiri: Card Login -->
    <div class="flex flex-col justify-center px-6 sm:px-12 lg:px-20 bg-white shadow-lg relative z-10">

        <!-- Branding -->
        <div class="mb-8 text-center lg:text-left">
            <img src="{{ asset('images/logo-ubh.png') }}" alt="Logo UBHARA" class="mx-auto lg:mx-0 w-20 h-20 mb-4">
            <h2 class="text-2xl font-bold text-indigo-700">Fakultas Ilmu Komputer</h2>
            <p class="text-sm text-gray-500">Universitas Bhayangkara Jakarta Raya</p>
        </div>

        <!-- Judul -->
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Selamat Datang 👋</h1>
            <p class="text-sm text-gray-600 mt-2">
                Masuk ke <span class="font-semibold text-indigo-700">Sistem Booking Lab Komputer</span>
            </p>
        </div>

        <!-- Status Session -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Username / Email -->
            <div>
                <label for="id_user" class="block text-sm font-medium text-gray-700">Email / Username</label>
                <input id="id_user" type="text" name="id_user" value="{{ old('id_user') }}" required autofocus autocomplete="id_user"
                    class="mt-2 block w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-800 shadow-sm
                           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" />
                <x-input-error :messages="$errors->get('id_user')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="mt-2 block w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-800 shadow-sm
                           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember + Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-gray-600">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline font-medium">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <!-- Tombol -->
            <div>
                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800
                           text-white font-semibold rounded-xl shadow-md transition transform hover:scale-[1.02]">
                    Masuk
                </button>
            </div>
        </form>

        <!-- Divider -->
        <div class="border-t border-gray-200 mt-10 mb-6"></div>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-500">
            © {{ date('Y') }} Fakultas Ilmu Komputer - Universitas Bhayangkara
        </p>
    </div>

    <!-- Kanan: Ilustrasi -->
    <div class="hidden lg:flex items-center justify-center bg-gradient-to-br from-indigo-100 via-blue-50 to-indigo-200 relative">
        <div class="text-indigo-800 max-w-md text-center px-8">
            <i class="fas fa-laptop-code text-7xl mb-6"></i>
            <h2 class="text-2xl font-bold">Sistem Booking Lab</h2>
            <p class="mt-3 text-sm text-indigo-700">
                Kelola jadwal laboratorium dengan mudah, cepat, dan efisien.
            </p>
        </div>
    </div>
</div>

</body>
</html>
