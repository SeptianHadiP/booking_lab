<x-guest-layout>
    <!-- Branding -->
    <div class="text-center mb-10">
        <h2 class="text-3xl font-extrabold text-indigo-700 dark:text-indigo-400">
            Fakultas Ilmu Komputer
        </h2>
        <p class="text-gray-600 dark:text-gray-400 text-sm">
            Universitas Bhayangkara
        </p>
    </div>

    <!-- Title -->
    <h1 class="text-center text-2xl font-bold text-gray-900 dark:text-white">
        Verifikasi Email Anda
    </h1>
    <p class="mt-4 text-center text-gray-600 dark:text-gray-300 leading-relaxed max-w-xl mx-auto">
        Halo, <span class="font-semibold">Mahasiswa & Dosen Fasilkom</span> 👋 <br>
        Untuk mengakses sistem
        <span class="font-semibold text-indigo-600 dark:text-indigo-400">Booking Lab Komputer</span>,
        silakan verifikasi email dengan klik link yang baru saja kami kirimkan.
    </p>

    <!-- Alert -->
    @if (session('status') == 'verification-link-sent')
        <div class="mt-6 text-green-700 bg-green-100 border border-green-300 rounded-lg px-5 py-3 text-sm text-center shadow-sm">
            ✅ Link verifikasi baru berhasil dikirim ke email Anda.
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full sm:w-auto px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md transition">
                <i class="fas fa-paper-plane mr-2"></i> Kirim Ulang Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full sm:w-auto px-6 py-3 rounded-lg bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold shadow transition">
                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
            </button>
        </form>
    </div>

    <!-- Tips -->
    <div class="mt-10 text-center text-sm text-gray-500 dark:text-gray-400">
        Tidak menemukan email? Coba cek folder <span class="font-semibold">Spam / Junk</span>. <br>
        Atau hubungi Admin Lab Komputer Fasilkom UBHARA untuk bantuan.
    </div>

    <!-- Footer -->
    <div class="mt-12 text-center text-xs text-gray-400">
        © {{ date('Y') }} Fakultas Ilmu Komputer - Universitas Bhayangkara <br>
        Sistem Booking Laboratorium Komputer
    </div>
</x-guest-layout>
