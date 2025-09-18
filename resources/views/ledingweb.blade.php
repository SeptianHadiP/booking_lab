<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Booking System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navbar -->
    <header
        x-data="{ scrolled: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
        :class="scrolled ? 'bg-blue-900 shadow-md' : 'bg-transparent'"
        class="fixed w-full top-0 left-0 z-50 transition-all duration-300"
    >
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <h1 class="text-white font-bold text-lg">Bhayangkara University</h1>
        <nav class="space-x-6 text-white hidden md:flex">
            <a href="#hero" class="hover:text-yellow-400">Home</a>
            <a href="#about" class="hover:text-yellow-400">About</a>
            <a href="#how" class="hover:text-yellow-400">How It Works</a>
            <a href="#benefits" class="hover:text-yellow-400">Benefits</a>
            <a href="#schedule" class="hover:text-yellow-400">Schedule</a>
            <a href="#contact" class="hover:text-yellow-400">Contact</a>
            <a href="#sertifikat" class="hover:text-yellow-400">Sertifikat</a>
        </nav>
        <div class="flex items-center gap-4">
            <span class="hidden md:block text-white">Kamis, 11 September 2025</span>
            <a href="#" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded">Login</a>
        </div>
        </div>
    </header>

    <section id="hero"
        x-data="{
            images: [
            '/assets/img/background/bg1.jpg',
            '/assets/img/background/bg2.jpg',
            '/assets/img/background/bg3.jpg'
            ],
            active: 0
        }"
        x-init="setInterval(() => { active = (active + 1) % images.length }, 5000)"
        class="h-screen flex flex-col justify-center items-center text-center bg-cover bg-center relative transition-all duration-1000"
        :style="`background-image: url(${images[active]});`"
        >
        <!-- Overlay -->
        <div class="absolute inset-0 bg-blue-900 bg-opacity-70"></div>
        <!-- Hero Content -->
        <div class="relative z-10 text-white px-6">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Laboratory Booking System</h2>
            <p class="max-w-2xl mx-auto mb-6">
            Mudahkan reservasi laboratorium di Universitas Bhayangkara. Kelola jadwal, hindari bentrok, dan optimalkan penggunaan sumber daya secara efisien.
            </p>
            <a href="{{ route('login') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded">
            Mulai Login
            </a>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="max-w-6xl mx-auto px-6 py-20">
        <div class="text-center mb-12">
        <h4 class="text-3xl md:text-4xl font-bold text-indigo-600 flex justify-center items-center gap-2">
            <i class="fas fa-info-circle"></i> Tentang Sistem
        </h4>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
            Sistem Booking Laboratorium ini dirancang untuk membantu Universitas Bhayangkara dalam mengelola
            sumber daya laboratorium secara <span class="font-semibold text-gray-800">efisien, cepat, dan transparan</span>.
        </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto">
        <div class="flex items-start gap-4">
            <div class="text-green-500 text-3xl"><i class="fas fa-calendar-check"></i></div>
            <div>
            <h5 class="font-semibold text-lg text-gray-800">Booking Laboratorium</h5>
            <p class="text-gray-600 text-sm">Membooking laboratorium untuk kegiatan kelas maupun riset akademik.</p>
            </div>
        </div>
        <div class="flex items-start gap-4">
            <div class="text-blue-500 text-3xl"><i class="fas fa-clock"></i></div>
            <div>
            <h5 class="font-semibold text-lg text-gray-800">Ketersediaan Real-time</h5>
            <p class="text-gray-600 text-sm">Melihat jadwal laboratorium yang tersedia secara real-time.</p>
            </div>
        </div>
        <div class="flex items-start gap-4">
            <div class="text-yellow-500 text-3xl"><i class="fas fa-history"></i></div>
            <div>
            <h5 class="font-semibold text-lg text-gray-800">Riwayat Booking</h5>
            <p class="text-gray-600 text-sm">Mengelola dan melacak riwayat booking laboratorium dengan mudah.</p>
            </div>
        </div>
        <div class="flex items-start gap-4">
            <div class="text-red-500 text-3xl"><i class="fas fa-mobile-alt"></i></div>
            <div>
            <h5 class="font-semibold text-lg text-gray-800">Akses Responsive</h5>
            <p class="text-gray-600 text-sm">Akses sistem dari perangkat apapun, baik desktop maupun mobile.</p>
            </div>
        </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how" class="px-6 py-20 bg-gray-50">
        <h4 class="text-center mb-12 text-2xl md:text-3xl font-semibold text-indigo-600">
            <i class="fas fa-cogs"></i> How It Works
        </h4>
        <div class="flex flex-wrap justify-center gap-6">
            <div class="bg-white border border-gray-200 p-6 rounded-xl w-60 text-center hover:shadow-xl hover:scale-105 transition">
            <i class="fas fa-user-plus text-yellow-400 text-4xl mb-3"></i>
            <h5 class="text-base font-semibold mb-1">1. Login</h5>
            <p class="text-gray-600 text-sm">Masuk dengan akun universitas Anda.</p>
            </div>
            <div class="bg-white border border-gray-200 p-6 rounded-xl w-60 text-center hover:shadow-xl hover:scale-105 transition">
            <i class="fas fa-calendar-alt text-yellow-400 text-4xl mb-3"></i>
            <h5 class="text-base font-semibold mb-1">2. Pilih Jadwal</h5>
            <p class="text-gray-600 text-sm">Cek ketersediaan laboratorium.</p>
            </div>
            <div class="bg-white border border-gray-200 p-6 rounded-xl w-60 text-center hover:shadow-xl hover:scale-105 transition">
            <i class="fas fa-check-circle text-yellow-400 text-4xl mb-3"></i>
            <h5 class="text-base font-semibold mb-1">3. Booking</h5>
            <p class="text-gray-600 text-sm">Konfirmasi pemesanan dan gunakan lab sesuai jadwal.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="px-6 py-20 text-center">
        <h4 class="text-3xl font-semibold text-purple-600">
        <i class="fas fa-comments"></i> Testimonials
        </h4>
        <div class="flex flex-wrap justify-center gap-8 mt-12">
        <div class="bg-white border border-gray-200 p-6 rounded-xl w-72 shadow hover:shadow-md transition">
            <p class="text-gray-600 italic mb-4">"Sangat membantu! Booking jadi lebih cepat dan tidak bentrok."</p>
            <span class="text-purple-600 font-semibold">- Dosen Informatika</span>
        </div>
        <div class="bg-white border border-gray-200 p-6 rounded-xl w-72 shadow hover:shadow-md transition">
            <p class="text-gray-600 italic mb-4">"User friendly banget, saya bisa atur jadwal riset dengan mudah."</p>
            <span class="text-purple-600 font-semibold">- Mahasiswa</span>
        </div>
        <div class="bg-white border border-gray-200 p-6 rounded-xl w-72 shadow hover:shadow-md transition">
            <p class="text-gray-600 italic mb-4">"Sebagai admin, saya bisa memantau semua penggunaan lab."</p>
            <span class="text-purple-600 font-semibold">- Admin Fakultas</span>
        </div>
        </div>
    </section>

    <!-- benefits -->
    <section id="benefits" class="bg-gray-50 px-6 py-16">
        <h4 class="text-2xl font-semibold text-blue-600 mb-10 text-center">
            <i class="fas fa-star"></i> Benefits
        </h4>

        <div class="max-w-4xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8">
            <!-- Rata kanan -->
            <div class="flex items-start justify-between gap-3 text-right">
            <p class="text-gray-700 font-medium">Efisiensi waktu pemesanan</p>
            <span class="text-2xl">⏱</span>
            </div>

            <!-- Normal -->
            <div class="flex items-start gap-3">
            <span class="text-2xl">📊</span>
            <p class="text-gray-700 font-medium">Monitoring pemakaian lab</p>
            </div>

            <!-- Rata kanan -->
            <div class="flex items-start justify-between gap-3 text-right">
            <p class="text-gray-700 font-medium">Akses mobile friendly</p>
            <span class="text-2xl">📱</span>
            </div>

            <!-- Normal -->
            <div class="flex items-start gap-3">
            <span class="text-2xl">🔒</span>
            <p class="text-gray-700 font-medium">Data aman & terintegrasi</p>
            </div>
        </div>
    </section>



    <!-- Contact -->
    <section id="contact" class="bg-gray-50 px-6 py-20 text-center">
        <h4 class="text-2xl font-semibold text-blue-600 mb-6">
            <i class="fas fa-envelope"></i> Contact Us
        </h4>
        <p class="text-gray-700">Email: <a href="mailto:labbooking@bhayangkara.ac.id" class="text-blue-600 hover:underline">labbooking@bhayangkara.ac.id</a></p>
        <p class="text-gray-700">Phone: <a href="tel:+622112345678" class="text-blue-600 hover:underline">(021) 1234-5678</a></p>
        <p class="text-gray-700">Alamat: Jl. Bhayangkara Raya No. 45, Jakarta</p>
    </section>

    <!-- CTA -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-center text-white py-20 px-6">
        <h3 class="text-3xl font-bold mb-6">Siap Mengoptimalkan Laboratorium?</h3>
        <a href="{{ route('login') }}" class="inline-block bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-8 py-3 rounded-lg font-semibold shadow-md transition">
            <i class="fas fa-sign-in-alt"></i> Login Sekarang
        </a>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">
        <!-- About -->
        <div>
            <h4 class="text-white font-semibold text-lg mb-4">Bhayangkara University</h4>
            <p class="text-sm leading-relaxed">
            Laboratory Booking System adalah platform untuk memudahkan reservasi laboratorium,
            menghindari bentrok jadwal, dan mengoptimalkan penggunaan fasilitas kampus.
            </p>
        </div>
        <!-- Quick Links -->
        <div>
            <h4 class="text-white font-semibold text-lg mb-4">Quick Links</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="/" class="hover:text-yellow-400 transition">Home</a></li>
                <li><a href="#about" class="hover:text-yellow-400 transition">About</a></li>
                <li><a href="#schedule" class="hover:text-yellow-400 transition">Schedule</a></li>
                <li><a href="#sertifikat" class="hover:text-yellow-400 transition">Sertifikat</a></li>
            </ul>
        </div>
        <!-- Contact -->
        <div>
            <h4 class="text-white font-semibold text-lg mb-4">Contact</h4>
            <ul class="space-y-2 text-sm">
                <li>📍 Jl. Raya Perjuangan No.81, Bekasi</li>
                <li>📞 +62 21 1234 5678</li>
                <li>✉️ lab-booking@ubhayangkara.ac.id</li>
            </ul>
        </div>
        <!-- Social Media -->
        <div>
            <h4 class="text-white font-semibold text-lg mb-4">Follow Us</h4>
            <div class="flex space-x-4">
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-700 hover:bg-blue-500 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-700 hover:bg-sky-400 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-700 hover:bg-pink-500 transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-700 hover:bg-red-500 transition"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        </div>
        <div class="border-t border-gray-700 mt-10 pt-4 text-center text-sm text-gray-500">
            © 2025 Bhayangkara University · Laboratory Booking System. All rights reserved.
        </div>
    </footer>
</body>
</html>
