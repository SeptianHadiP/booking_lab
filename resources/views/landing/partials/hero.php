<section id="hero"
  x-data="{ images: ['/assets/img/background/bg1.jpg','/assets/img/background/bg2.jpg','/assets/img/background/bg3.jpg'], active: 0 }"
  x-init="setInterval(() => { active = (active + 1) % images.length }, 5000)"
  class="h-screen flex flex-col justify-center items-center text-center bg-cover bg-center relative transition-all duration-1000"
  :style="`background-image: url(${images[active]});`"
>
  <div class="absolute inset-0 bg-blue-900 bg-opacity-70"></div>
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
