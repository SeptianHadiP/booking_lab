<x-guest-layout>
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

        <!-- Bagian Kiri: Form Login -->
        <div class="flex flex-col justify-center px-8 sm:px-16 lg:px-24 bg-white dark:bg-gray-900">

            <!-- Branding -->
            <div class="mb-8 text-center lg:text-left">
                <h2 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                    Fakultas Ilmu Komputer
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Universitas Bhayangkara
                </p>
            </div>

            <!-- Judul -->
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-2">
                Selamat Datang 👋
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-8">
                Silakan masuk untuk mengakses <span class="font-semibold text-indigo-600 dark:text-indigo-400">Sistem Booking Lab Komputer</span>
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Username / Email -->
                <div>
                    <label for="id_user" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email / Username</label>
                    <input id="id_user" type="text" name="id_user" value="{{ old('id_user') }}" required autofocus autocomplete="id_user"
                        class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('id_user')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me + Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:ring-indigo-600">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Tombol -->
                <div>
                    <button type="submit"
                        class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition">
                        Masuk
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <p class="mt-8 text-center text-xs text-gray-500 dark:text-gray-400">
                © {{ date('Y') }} Fakultas Ilmu Komputer - Universitas Bhayangkara
            </p>
        </div>

        <!-- Bagian Kanan: Ilustrasi -->
        <div class="hidden lg:flex items-center justify-center bg-gradient-to-br from-indigo-600 to-purple-600">
            <div class="text-white max-w-md text-center">
                <i class="fas fa-laptop-code text-6xl mb-6"></i>
                <h2 class="text-2xl font-bold">Sistem Booking Lab</h2>
                <p class="mt-2 text-sm text-indigo-100">Kelola jadwal laboratorium dengan mudah, cepat, dan efisien.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
