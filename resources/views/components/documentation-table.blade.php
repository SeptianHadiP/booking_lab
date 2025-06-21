@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <h2 class="h4 fw-semibold text-dark mb-4">Daftar Jadwal Praktikum</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    <th>Nama Dosen</th>
                    <th>Tanggal Praktikum</th>
                    <th>Waktu</th>
                    <th style="width: 170px;">Status Dokumentasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $schedule)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $schedule->mata_kuliah }}</td>
                        <td>{{ $schedule->kelas }}</td>
                        <td>{{ $schedule->nama_dosen }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->format('d M Y') }}</td>
                        <td>{{ $schedule->waktu_praktikum }}</td>
                        <td>
                            @if ($schedule->documentation)
                                <a href="{{ route('documentations.show', $schedule->documentation->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i> Lihat
                                </a>
                            @else
                                <a href="{{ route('documentations.create', $schedule->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Dokumentasi
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada jadwal praktikum.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
