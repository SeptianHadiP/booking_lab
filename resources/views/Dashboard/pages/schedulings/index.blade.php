@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Jadwal Praktikum</h2>
            <p class="text-muted small mb-0">Kelola semua jadwal yang telah ditambahkan</p>
        </div>
        <a href="{{ route('scheduling.create') }}" class="btn btn-success">
            + Tambah Jadwal
        </a>
    </div>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Jadwal -->
    <div class="table-responsive">
        <table id="scheduleTable" class="table table-bordered table-hover table-sm align-middle text-sm w-100">
            <thead class="table-light text-center">
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Nama Dosen</th>
                    <th style="min-width: 150px;">Kelas</th>
                    <th style="min-width: 150px;">Tanggal</th>
                    <th style="width: 80px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $schedule)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $schedule->nama_dosen }}</td>
                        <td>
                            <small class="text-muted">{{ $schedule->mata_kuliah }}</small><br>
                            {{ $schedule->kelas }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->format('d M Y') }}<br>
                            <small class="text-muted">{{ $schedule->waktu_praktikum }}</small>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="#" class="dropdown-item">
                                            <i class="fa fa-eye text-primary me-2"></i> Lihat
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('scheduling.update', $schedule->id) }}" class="dropdown-item">
                                            <i class="fa fa-pencil text-warning me-2"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('scheduling.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fa fa-trash me-2"></i> Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data jadwal.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#scheduleTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            order: [],
            columnDefs: [
                { orderable: false, targets: 4 } // kolom aksi tidak bisa diurutkan
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                },
                zeroRecords: "Data tidak ditemukan",
            }
        });
    });
</script>
@endpush

<script>
    setTimeout(function () {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.remove('show'); // animasi hilang
            alert.classList.add('fade');
            // Tunggu animasi, lalu hapus dari DOM
            setTimeout(() => alert.remove(), 500);
        }
    }, 4000); // 4 detik
</script>
