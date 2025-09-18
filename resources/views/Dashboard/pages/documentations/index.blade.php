@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <!-- Header -->
    <div class="flex flex-wrap items-start justify-between gap-2 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Daftar Jadwal & Dokumentasi</h2>
            <p class="text-sm text-gray-500">Berikut adalah daftar jadwal praktikum beserta status dokumentasinya.</p>
        </div>
    </div>

    <!-- Notifikasi -->
    @if (session('success'))
        <x-alert-toast type="success" :message="session('success')" />
    @endif

    <!-- Include Tabel -->
    @include('components.documentation-table', ['schedules' => $schedules])
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#scheduleTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            order: [],
            columnDefs: [
                { orderable: false, targets: 4 }
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

    // SweetAlert2 Delete Confirmation
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data ini tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validasi Gagal',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        confirmButtonText: 'OK'
    });
</script>
@endif
@endpush
