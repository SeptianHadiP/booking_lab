<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Create Account | Anywhere App</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-900 text-white font-sans"> 
        <!-- Main Section -->
        <section class="relative min-h-screen flex items-center">
            <!-- Background image -->
            <div class="absolute inset-0">
                <div
                x-data="{ images: ['/assets/img/background/bg1.jpg','/assets/img/background/bg2.jpg','/assets/img/background/bg3.jpg'], active: 0 }"
                x-init="setInterval(() => { active = (active + 1) % images.length }, 5000)"
                class="absolute inset-0 h-full w-full  bg-center transition-all duration-1000 object-cover"
                :style="`background-image: url(${images[active]});`"
                >

                <!-- Gradient overlay (gelap di kiri, transparan ke kanan) -->
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900 from-40% via-gray-900/80 via-65% to-transparent"></div>
            </div>

            <!-- Form -->
            <div class="relative w-full lg:w-1/2 px-6 lg:px-20 flex flex-col justify-center min-h-screen">
                <!-- Branding -->
                <div class="mb-8 text-center lg:text-center">
                    <h2 class="text-2xl font-bold text-indigo-700">Fakultas Ilmu Komputer</h2>
                    <p class="text-sm text-gray-500">Universitas Bhayangkara Jakarta Raya</p>
                </div>
                <!-- Header -->
                <div class="mb-10">
                    <h1 class="text-3xl font-bold">Selamat Datang 👋<span class="text-blue-500">.</span></h1>
                    <p class="text-sm text-gray-600 mt-2">
                        Masuk ke <span class="font-semibold text-indigo-700">Sistem Booking Lab Komputer</span>
                    </p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <input id="id_user" type="text" name="id_user" value="{{ old('id_user') }}" required autofocus autocomplete="id_user" placeholder="Email / Username"
                        class="w-full px-4 py-3 rounded-lg bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <x-input-error :messages="$errors->get('id_user')" class="mt-2" />
                    </div>
                    <div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password"
                        class="w-full px-4 py-3 rounded-lg bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                           
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

                    <!-- Buttons -->
                    <div class="flex items-center gap-4 pt-4">
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

            <!-- Logo pojok kanan bawah -->
            <div class="absolute bottom-6 right-6 text-white text-3xl font-bold"><img src="https://ubharajaya.ac.id/wp-content/uploads/2022/07/ubj_nama-copy.png"
                 class="h-8 w-auto" alt="UBH Logo"></div>
        </section>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    </body>
</html>
