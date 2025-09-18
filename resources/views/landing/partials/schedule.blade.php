<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Timeline Jadwal Kelas</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .plane {
      animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(5deg); }
      50% { transform: translateY(-8px) rotate(-5deg); }
    }
  </style>
</head>
<body class="bg-gray-50 font-sans">

  <div class="max-w-6xl mx-auto py-16 relative">
    <!-- Header -->
    <h2 class="text-3xl font-extrabold text-center mb-20 text-gray-800">
      Timeline Jadwal Kelas
    </h2>

    <!-- Garis + pesawat -->
    <svg class="absolute left-1/2 -translate-x-1/2 top-28 h-[900px] w-60 z-0" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M150 0 
               C 150 80, 80 120, 80 200 
               S 150 320, 150 400 
               S 80 520, 80 600 
               S 150 720, 150 800" 
            stroke="#9CA3AF" stroke-width="2" stroke-dasharray="6 6" fill="transparent" />

      <!-- Pesawat -->
      <g class="plane">
        <path d="M150 -15 L180 5 L150 0 L120 5 Z" fill="none" stroke="#374151" stroke-width="2"/>
        <path d="M150 -15 L150 0" stroke="#374151" stroke-width="2"/>
      </g>
    </svg>

    <!-- Timeline items -->
    <div class="relative z-10 space-y-32">
      <!-- Kiri -->
      <div class="flex justify-start">
        <div class="w-1/2 flex justify-end -translate-x-8">
          <div class="p-5 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 min-w-[220px] text-center border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Senin | 08:00 - 10:00</p>
            <h3 class="text-lg font-semibold text-gray-800">Kelas 1</h3>
          </div>
        </div>
      </div>

      <!-- Kanan -->
      <div class="flex justify-end">
        <div class="w-1/2 flex justify-start translate-x-8">
          <div class="p-5 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 min-w-[220px] text-center border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Selasa | 10:00 - 12:00</p>
            <h3 class="text-lg font-semibold text-gray-800">Kelas 2</h3>
          </div>
        </div>
      </div>

      <!-- Kiri -->
      <div class="flex justify-start">
        <div class="w-1/2 flex justify-end -translate-x-8">
          <div class="p-5 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 min-w-[220px] text-center border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Rabu | 13:00 - 15:00</p>
            <h3 class="text-lg font-semibold text-gray-800">Kelas 3</h3>
          </div>
        </div>
      </div>

      <!-- Kanan -->
      <div class="flex justify-end">
        <div class="w-1/2 flex justify-start translate-x-8">
          <div class="p-5 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 min-w-[220px] text-center border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Kamis | 15:00 - 17:00</p>
            <h3 class="text-lg font-semibold text-gray-800">Kelas 4</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
