@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h2 class="h4 fw-semibold text-dark mb-3">Daftar Jadwal & Dokumentasi</h2>
        <p class="text-muted mb-4">Berikut adalah daftar jadwal praktikum beserta status dokumentasinya.</p>
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
<script>
    $(document).ready(function () {
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
@endpush
