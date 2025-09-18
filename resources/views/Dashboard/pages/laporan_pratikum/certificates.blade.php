<!-- resources/views/dashboard/pages/laporan_pratikum/certificates.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sertifikat - {{ $laprak->mata_kuliah_praktikum->nama_mata_kuliah }}</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-600 to-purple-700 text-white py-5 shadow-md">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-2xl md:text-3xl font-bold flex justify-center items-center gap-2">
                <i class="fa fa-certificate text-yellow-400"></i>
                Daftar Sertifikat - {{ $laprak->mata_kuliah_praktikum->nama_mata_kuliah }}
            </h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-10 max-w-5xl">

        <!-- Info Card -->
        <div class="bg-white shadow-md rounded-2xl p-5 mb-8 border-l-4 border-purple-600 flex flex-col sm:flex-row justify-between gap-4 text-gray-800 text-sm sm:text-base">
            <div class="flex items-center gap-2"><i class="fa fa-book text-purple-600"></i>Mata Kuliah: <strong>{{ $laprak->mata_kuliah_praktikum->nama_mata_kuliah }}</strong></div>
            <div class="flex items-center gap-2"><i class="fa fa-users text-purple-600"></i>Kelas: <strong>{{ $laprak->kelas->nama_kelas }}</strong></div>
            <div class="flex items-center gap-2"><i class="fa fa-calendar text-purple-600"></i>Tahun Ajaran: <strong>{{ $laprak->semester->tahun_ajar }}</strong></div>
        </div>

        <!-- Sertifikat Grid -->
        @if(count($certificateFiles) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($certificateFiles as $file)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-5 flex flex-col items-center text-center border-t-2 border-purple-600">
                        <i class="fa fa-file-pdf-o text-5xl text-purple-600 mb-3"></i>
                        <!-- Truncate panjang nama file -->
                        <span class="font-medium text-gray-800 text-sm sm:text-base max-w-full overflow-hidden text-ellipsis whitespace-nowrap block">
                            {{ basename($file) }}
                        </span>
                        <a href="{{ asset('storage/' . $file) }}" target="_blank"
                           class="mt-3 px-4 py-1.5 bg-purple-600 text-white text-sm rounded-full hover:bg-purple-700 transition shadow-sm">
                            Buka
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <i class="fa fa-hourglass-half text-6xl text-gray-400 mb-4 animate-pulse"></i>
                <p class="text-gray-500 text-base sm:text-lg">Belum ada sertifikat tersedia.<br>Tunggu Aslab atau Kalab membuat sertifikat.</p>
            </div>
        @endif

    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 py-4 mt-auto">
        <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
            &copy; {{ date('Y') }} Sistem Laporan Praktikum
        </div>
    </footer>

</body>
</html>
