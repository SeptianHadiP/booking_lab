<footer class="bg-gray-900 text-gray-300 pt-16 pb-8">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">
    {{-- About --}}
    <div>
      <h4 class="text-white font-semibold text-lg mb-4">Bhayangkara University</h4>
      <p class="text-sm leading-relaxed">
        Laboratory Booking System adalah platform untuk memudahkan reservasi laboratorium,
        menghindari bentrok jadwal, dan mengoptimalkan penggunaan fasilitas kampus.
      </p>
    </div>
    {{-- Quick Links --}}
    <div>
      <h4 class="text-white font-semibold text-lg mb-4">Quick Links</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="/" class="hover:text-yellow-400 transition">Home</a></li>
        <li><a href="#about" class="hover:text-yellow-400 transition">About</a></li>
        <li><a href="#schedule" class="hover:text-yellow-400 transition">Schedule</a></li>
        <li><a href="{{ route('sertifikat.index') }}" class="hover:text-yellow-400 transition">Sertifikat</a></li>
      </ul>
    </div>
    {{-- Contact --}}
    <div>
      <h4 class="text-white font-semibold text-lg mb-4">Contact</h4>
      <ul class="space-y-2 text-sm">
        <li>📍 Jl. Raya Perjuangan No.81, Bekasi</li>
        <li>📞 +62 21 1234 5678</li>
        <li>✉️ lab-booking@ubhayangkara.ac.id</li>
      </ul>
    </div>
    {{-- Social --}}
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
