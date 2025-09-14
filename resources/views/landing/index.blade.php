@extends('landing.layout')

@section('title', 'Landing Page - Laboratory Booking System')

@section('content')
<section id="home" class="hero min-h-screen flex flex-col justify-center items-center text-white text-center px-4" style="background: linear-gradient(rgba(30,58,138,0.75), rgba(30,58,138,0.75)), url('/assets/img/background/bg1.jpg') center/cover no-repeat;">
  <h2 class="text-4xl md:text-5xl font-bold mb-4"><i class="fas fa-flask"></i> Laboratory Booking System</h2>
  <p class="max-w-2xl text-lg md:text-xl mb-6">Mudahkan reservasi laboratorium di Universitas Bhayangkara. Kelola jadwal, hindari bentrok, dan optimalkan penggunaan sumber daya secara efisien.</p>
  <a href="{{ route('login') }}" class="btn bg-yellow-400 hover:bg-yellow-300 text-gray-800 font-semibold px-6 py-3 rounded shadow flex items-center gap-2 transition"><i class="fas fa-sign-in-alt"></i> Mulai Login</a>
</section>

<section class="features py-16 bg-gray-50 flex flex-wrap justify-center gap-8">
  <div class="feature bg-white p-6 rounded-lg shadow hover:shadow-lg transition w-72 text-center">
    <i class="fas fa-calendar-check text-4xl text-blue-600 mb-3"></i>
    <h3 class="text-xl font-semibold mb-2 text-purple-700">Easy Booking</h3>
    <p class="text-gray-700 text-sm">Reservasi laboratorium cepat & intuitif dengan pengecekan real-time.</p>
  </div>
  <div class="feature bg-white p-6 rounded-lg shadow hover:shadow-lg transition w-72 text-center">
    <i class="fas fa-clock text-4xl text-blue-600 mb-3"></i>
    <h3 class="text-xl font-semibold mb-2 text-purple-700">Schedule Management</h3>
    <p class="text-gray-700 text-sm">Atur jadwal & hindari bentrokan dengan kalender terintegrasi.</p>
  </div>
  <div class="feature bg-white p-6 rounded-lg shadow hover:shadow-lg transition w-72 text-center">
    <i class="fas fa-users-cog text-4xl text-blue-600 mb-3"></i>
    <h3 class="text-xl font-semibold mb-2 text-purple-700">Multi-User Access</h3>
    <p class="text-gray-700 text-sm">Akses terpisah untuk dosen & admin sesuai kebutuhan.</p>
  </div>
</section>
@endsection
