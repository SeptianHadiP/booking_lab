{{-- resources/views/components/schedule-table.blade.php --}}
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
                    <td>{{ $schedule->user->name ?? 'Tidak ada data' }}</td>
                    <td>
                        {{ $schedule->mata_kuliah_praktikum->nama_mata_kuliah ?? 'Mata kuliah tidak ditemukan' }}<br>
                        <small class="text-muted">{{ $schedule->kelas->nama_kelas ?? '-' }}</small>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->format('d M Y') }}<br>
                        <small class="text-muted">{{ $schedule->waktu_praktikum }}</small>
                    </td>
                    <td>
                        @role('aslab')
                            @if ($schedule->documentation)
                                <a href="{{ route('documentations.show', $schedule->documentation->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i> Lihat
                                </a>
                            @else
                                <a href="{{ route('documentations.create', $schedule->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Dokumentasi
                                </a>
                            @endif
                        @else
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="{{ route('schedulings.show', $schedule->id) }}" class="dropdown-item">
                                            <i class="fa fa-eye text-primary me-2"></i> Lihat
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('schedulings.edit', $schedule->id) }}" class="dropdown-item">
                                            <i class="fa fa-pencil text-warning me-2"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <button class="dropdown-item text-danger" onclick="confirmDelete('{{ $schedule->id }}')">
                                            <i class="fa fa-trash me-2"></i> Hapus
                                        </button>
                                        <form id="delete-form-{{ $schedule->id }}" action="{{ route('schedulings.destroy', $schedule->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('documentations.create', $schedule->id) }}" class="dropdown-item">
                                            <i class="fa fa-camera text-success me-2"></i> Dokumentasi
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endrole
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
