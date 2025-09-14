<header
  x-data="{ scrolled: false }"
  x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
  @if(request()->routeIs('sertifikat.index') || request()->routeIs('sertifikat.filter'))
    class="fixed w-full top-0 left-0 z-50 bg-blue-900 shadow-md transition-all duration-300"
  @else
    :class="scrolled ? 'bg-blue-900 shadow-md' : 'bg-transparent'"
    class="fixed w-full top-0 left-0 z-50 transition-all duration-300"
  @endif
>
  <div class="container mx-auto flex justify-between items-center px-6 py-4">
    <h1 class="text-white font-bold text-lg">Bhayangkara University</h1>
    <nav class="space-x-6 text-white hidden md:flex">
      <a href="{{ url('/') }}" class="hover:text-yellow-400">Home</a>
      <a href="/#about" class="hover:text-yellow-400">About</a>
      <a href="/#how" class="hover:text-yellow-400">How It Works</a>
      <a href="/#benefits" class="hover:text-yellow-400">Benefits</a>
      <a href="/#schedule" class="hover:text-yellow-400">Schedule</a>
      <a href="/#contact" class="hover:text-yellow-400">Contact</a>
      <a href="{{ route('sertifikat.index') }}" class="hover:text-yellow-400">Sertifikat</a>
    </nav>
    <div class="flex items-center gap-4">
      <span class="hidden md:block text-white">{{ now()->translatedFormat('l, d F Y') }}</span>
      <a href="{{ route('login') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded">Login</a>
    </div>
  </div>
</header>
