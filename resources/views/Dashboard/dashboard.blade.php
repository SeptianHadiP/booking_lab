@extends('dashboard.layouts.app')

@section('title', 'Dashboard - Bhayangkara University Lab Booking')

@section('content')
<div class="p-6 space-y-6">

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="text-sm text-gray-500">Total Jadwal Semester Ini</h3>
            <p class="text-2xl font-bold text-blue-600">{{ $schedules->count() }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="text-sm text-gray-500">Sesi Selesai / Total</h3>
            <p class="text-2xl font-bold text-green-600">
                {{ $schedules->whereNotNull('documentation')->count() }} / {{ $schedules->count() }}
            </p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="text-sm text-gray-500">Laporan Dosen Masuk</h3>
            <p class="text-2xl font-bold text-purple-600">{{ $lapraks->count() }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="text-sm text-gray-500">Sertifikat Dihasilkan</h3>
            <p class="text-2xl font-bold text-orange-600">
                {{ $lapraks->filter(function($laprak){
                    $tahunAjaran = \Illuminate\Support\Str::slug($laprak->semester->tahun_ajar ?? date('Y'));
                    $mataKuliah  = \Illuminate\Support\Str::slug($laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? 'mata-kuliah');
                    $kelas       = \Illuminate\Support\Str::slug($laprak->kelas->nama_kelas ?? 'kelas');
                    $basePath    = "generated_certificates/{$tahunAjaran}/{$mataKuliah}/{$kelas}";
                    return \Illuminate\Support\Facades\Storage::disk('public')->exists($basePath);
                })->count() }}
            </p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="text-sm text-gray-500">Pemakaian Lab</h3>
            <p class="text-2xl font-bold text-pink-600">{{ $schedules->count() }}</p>
        </div>
    </div>


    <!-- 2 Kolom Utama -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri -->
        <div class="lg:col-span-2 space-y-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Progress Praktikum per Kelas -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-base font-semibold text-gray-700 mb-4">
                        Progress Praktikum per Kelas (Semester {{ $semesterAktif->tahun_ajar ?? '-' }})
                    </h3>
                    <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Kelas</th>
                                <th class="px-4 py-2 text-left">Dosen</th>
                                <th class="px-4 py-2 text-center">Tempat Lab</th>
                                <th class="px-4 py-2 text-center">Dokumentasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedulesBelum as $schedule)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $schedule->kelas->nama_kelas ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $schedule->user->name ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ $schedule->laboratorium->nama_ruangan ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">
                                    <span class="px-2 py-1 text-xs bg-orange-100 text-orange-600 rounded">Belum</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-4 py-3 text-center text-gray-500">Semua sudah selesai</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Progress Laporan Praktikum per Kelas -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-base font-semibold text-gray-700 mb-4">
                        Progress Laporan Praktikum per Kelas (Semester {{ $semesterAktif->tahun_ajar ?? '-' }})
                    </h3>
                    <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Kelas</th>
                                <th class="px-4 py-2 text-left">Dosen</th>
                                <th class="px-4 py-2 text-center">File Nilai (Excel)</th>
                                <th class="px-4 py-2 text-center">Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lapraksBelum as $laprak)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $laprak->kelas->nama_kelas ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $laprak->user->name ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if(!$laprak->nilai_file)
                                        <span class="px-2 py-1 text-xs bg-orange-100 text-orange-600 rounded">Belum</span>
                                    @else
                                        <a href="{{ asset('storage/'.$laprak->nilai_file) }}" 
                                        class="text-blue-600 hover:underline" target="_blank">
                                        Lihat File
                                        </a>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <span class="px-2 py-1 text-xs bg-gray-200 text-gray-500 rounded">Belum</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-4 py-3 text-center text-gray-500">Semua sudah selesai</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-3">Aktivitas Terbaru</h2>
                <ul class="space-y-2 text-sm">
                    @foreach($schedules->take(3) as $schedule)
                        <li>📌 Jadwal {{ $schedule->mata_kuliah_praktikum->nama_mata_kuliah ?? '-' }} - {{ $schedule->kelas->nama_kelas ?? '' }} di {{ $schedule->laboratorium->nama_ruangan ?? '' }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Table -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-3">Penjadwalan Lab</h2>

                <!-- Show Entries -->
                <div class="flex items-center gap-2 mb-5">
                    <label class="text-sm text-gray-600">Tampilkan</label>
                    <select id="pageLength" class="px-2 py-1 text-sm border rounded">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-sm text-gray-600">data</span>
                </div>
                
                <table id="schedulesTable" class="w-full text-sm text-gray-700 border-collapse">
                    <thead class="bg-gray-100 text-xs uppercase text-gray-700 tracking-wide shadow-sm">
                        <tr>
                            <th class="px-4 py-3 text-center border">No</th>
                            <th class="px-4 py-3 text-center border">Nama</th>
                            <th class="px-4 py-3 text-center border">Mata Kuliah</th>
                            <th class="px-4 py-3 text-center border">Kelas</th>
                            <th class="px-4 py-3 text-center border">Lab</th>
                            <th class="px-4 py-3 text-center border">Tahun Ajaran</th>
                            <th class="px-4 py-3 text-center border">Tanggal</th>
                            <th class="px-4 py-3 text-center border">Jam</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($schedules as $schedule)
                        <tr class="even:bg-gray-50 hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3 text-center font-medium text-gray-600 border">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 font-medium border">
                                {{ $schedule->user->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 border">
                                {{ $schedule->mata_kuliah_praktikum->nama_mata_kuliah ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 border">
                                {{ $schedule->kelas->nama_kelas ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 border">
                                {{ $schedule->laboratorium->nama_ruangan ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-left border">
                                {{ $schedule->semester->tahun_ajar ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-left border">
                                {{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-left border">
                                {{ $schedule->waktu_praktikum }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-gray-500 py-6 italic border">
                                Belum ada data jadwal.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Footer Custom Pagination -->
                <div class="flex flex-col items-center justify-between gap-2 mt-4 md:flex-row">
                    <p id="customInfo" class="text-sm text-gray-500"></p>
                    <div id="customPagination" class="flex items-center gap-1"></div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="space-y-6">
            <!-- Judul dan Tombol Kontrol Kalender -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex flex-wrap justify-between items-center mb-4">
                    <div class="flex items-center space-x-2">
                        <button id="prevBtn" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">‹</button>
                        <button id="nextBtn" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">›</button>
                        <button id="todayBtn" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">Hari Ini</button>
                    </div>
                    <!-- Judul Dinamis Bulan & Tahun -->
                    <h2 id="calendarTitle" class="text-xl font-bold text-gray-800"></h2>
                    <div class="flex space-x-2">
                        <button data-view="dayGridMonth" class="viewBtn px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Bulan</button>
                        <button data-view="timeGridWeek" class="viewBtn px-3 py-1 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Minggu</button>
                        <button data-view="timeGridDay" class="viewBtn px-3 py-1 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Hari</button>
                        <button data-view="listWeek" class="viewBtn px-3 py-1 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Agenda</button>
                    </div>
                </div>

                <!-- Kalender -->
                <div id="calendar" class="border border-gray-200 rounded-lg shadow-inner"></div>
            </div>

            <!-- Legend -->
            <div class="flex space-x-4 text-sm items-center">
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span><span>Lab Software</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span><span>Lab Cyber</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-red-500 rounded-full"></span><span>Lab Data Science</span>
                </div>
            </div>


            <!-- Grafik -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-3">Grafik Ringkas</h2>
                <canvas id="chartLabUsage" class="mb-6"></canvas>
                <canvas id="chartStatus"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var titleEl = document.getElementById('calendarTitle');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: false,
            events: [
                @foreach($schedules as $schedule)
                @php
                    $labName = strtolower($schedule->laboratorium->nama_ruangan ?? '');
                    $color = '#6c757d'; // default abu
                    if (str_contains($labName, 'software')) $color = '#007bff';
                    elseif (str_contains($labName, 'cyber')) $color = '#28a745';
                    elseif (str_contains($labName, 'data')) $color = '#dc3545';
                    $jamRange = explode('-', $schedule->waktu_praktikum);
                    $jamMulai = trim($jamRange[0] ?? '00:00');
                    $jamSelesai = trim($jamRange[1] ?? $jamMulai);
                @endphp
                {
                    title: '{{ $schedule->mata_kuliah_praktikum->nama_mata_kuliah ?? "-" }} ({{ $schedule->kelas->nama_kelas ?? "" }})',
                    start: '{{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->format("Y-m-d") }}T{{ $jamMulai }}:00',
                    end: '{{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->format("Y-m-d") }}T{{ $jamSelesai }}:00',
                    description: 'Lab: {{ $schedule->laboratorium->nama_ruangan ?? "-" }} | Dosen: {{ $schedule->user->name ?? "-" }}',
                    backgroundColor: '{{ $color }}',
                    borderColor: '{{ $color }}',
                    textColor: 'white'
                },
                @endforeach
            ],
            nowIndicator: true,
            height: 'auto',
            datesSet: function(info) {
                // Update judul setiap kali bulan/ganti view
                titleEl.innerText = calendar.view.title;
            }
        });

        calendar.render();
        titleEl.innerText = calendar.view.title; // set judul awal

        // Tombol navigasi
        document.getElementById('prevBtn').addEventListener('click', function() {
            calendar.prev();
            titleEl.innerText = calendar.view.title;
        });
        document.getElementById('nextBtn').addEventListener('click', function() {
            calendar.next();
            titleEl.innerText = calendar.view.title;
        });
        document.getElementById('todayBtn').addEventListener('click', function() {
            calendar.today();
            titleEl.innerText = calendar.view.title;
        });

        // Tombol ganti view
        document.querySelectorAll('.viewBtn').forEach(function(btn){
            btn.addEventListener('click', function(){
                var view = btn.getAttribute('data-view');
                calendar.changeView(view);
                titleEl.innerText = calendar.view.title;

                document.querySelectorAll('.viewBtn').forEach(b => {
                    b.classList.remove('bg-blue-500', 'text-white');
                    b.classList.add('bg-gray-200', 'text-gray-800');
                });
                btn.classList.remove('bg-gray-200', 'text-gray-800');
                btn.classList.add('bg-blue-500', 'text-white');
            });
        });
    });

    
    // === Chart 1: Pemakaian Lab per Ruang (Bar Chart) ===
new Chart(document.getElementById('chartLabUsage'), {
    type: 'bar',
    data: {
        labels: @json($schedules->pluck('laboratorium.nama_ruangan')->unique()->values()),
        datasets: [{
            label: 'Jumlah Pemakaian Lab',
            data: @json($schedules->groupBy('laboratorium.nama_ruangan')->map->count()->values()),
            backgroundColor: '#3b82f6'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Pemakaian Lab per Ruang'
            }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});


// === Chart 2: Status Laporan & Sertifikat (Pie Chart) ===
new Chart(document.getElementById('chartStatus'), {
    type: 'pie',
    data: {
        labels: ['Laporan Masuk', 'Laporan Belum', 'Sertifikat Jadi', 'Sertifikat Belum'],
        datasets: [{
            data: [
                {{ $lapraks->count() }}, // laporan masuk
                {{ max($schedules->count() - $lapraks->count(), 0) }}, // laporan belum
                {{ $lapraks->filter(function($laprak){
                    $tahunAjaran = \Illuminate\Support\Str::slug($laprak->semester->tahun_ajar ?? date('Y'));
                    $mataKuliah  = \Illuminate\Support\Str::slug($laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? 'mata-kuliah');
                    $kelas       = \Illuminate\Support\Str::slug($laprak->kelas->nama_kelas ?? 'kelas');
                    $path        = "generated_certificates/{$tahunAjaran}/{$mataKuliah}/{$kelas}";
                    return \Illuminate\Support\Facades\Storage::disk('public')->exists($path);
                })->count() }}, // sertifikat jadi
                {{ max($lapraks->count() - $lapraks->filter(function($laprak){
                    $tahunAjaran = \Illuminate\Support\Str::slug($laprak->semester->tahun_ajar ?? date('Y'));
                    $mataKuliah  = \Illuminate\Support\Str::slug($laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? 'mata-kuliah');
                    $kelas       = \Illuminate\Support\Str::slug($laprak->kelas->nama_kelas ?? 'kelas');
                    $path        = "generated_certificates/{$tahunAjaran}/{$mataKuliah}/{$kelas}";
                    return \Illuminate\Support\Facades\Storage::disk('public')->exists($path);
                })->count(), 0) }} // sertifikat belum
            ],
            backgroundColor: ['#22c55e', '#f87171', '#3b82f6', '#facc15']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Status Laporan & Sertifikat'
            }
        }
    }
});

</script>
@endpush
