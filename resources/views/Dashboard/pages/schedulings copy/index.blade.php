<!-- resources/views/dashboard/pages/schedulings/index.blade.php -->
@extends('dashboard.layouts.app')
@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Jadwal Praktikum</h2>
            <p class="text-sm text-gray-500">Kelola semua jadwal yang telah ditambahkan</p>
        </div>
        <a href="{{ route('schedulings.create') }}"
           class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700 transition">
           + Tambah Jadwal
        </a>
    </div>

    <!-- Export Buttons -->
    <div class="flex flex-wrap gap-2 mb-4">
        <button id="btnCsv" class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50">CSV</button>
        <button id="btnExcel" class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50">Excel</button>
        <button id="btnPdf" class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50">PDF</button>
        <button id="btnPrint" class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50">Print</button>

        <!-- Column Visibility Dropdown -->
        <div class="relative inline-block text-left">
            <button id="btnColvis"
                class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50 flex items-center gap-1">
                Column visibility
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="colvisDropdown"
                class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
        <!-- Search + Filter -->
        <div class="flex items-center gap-2">
            <!-- Search Box -->
            <div class="relative">
                <input id="searchBox"
                       type="text"
                       placeholder="Cari jadwal..."
                       class="w-56 pl-10 pr-4 py-2 text-sm text-gray-700 bg-white border rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300" />
                <!-- Search Icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.75 3.75a7.5 7.5 0 0012.9 12.9z" />
                </svg>
            </div>

            <!-- Tombol Filter -->
            <button class="flex items-center gap-1 px-3 py-2 text-sm text-gray-600 bg-white border rounded-full shadow-sm hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-.447.894l-4 2.5A1 1 0 019 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                Filter
            </button>
        </div>

        <!-- Show Entries -->
        <div class="flex items-center gap-2">
            <label class="text-sm text-gray-600">Tampilkan</label>
            <select id="pageLength" class="px-2 py-1 text-sm border rounded">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span class="text-sm text-gray-600">data</span>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-lg shadow">
        <table id="schedulesTable" class="w-full text-sm text-gray-700 border-collapse">
            <!-- Header -->
            <thead class="bg-gray-100 text-xs uppercase text-gray-700 tracking-wide shadow-sm">
                <tr>
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-left">Nama Dosen</th>
                    <th class="px-4 py-3 text-left">Kelas</th>
                    <th class="px-4 py-3 text-center">Tanggal</th>
                    <th class="px-4 py-3 text-center">Jam</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="divide-y divide-gray-200">
                @forelse ($schedules as $schedule)
                <tr class="even:bg-gray-50 hover:bg-blue-50 transition-colors">
                    <!-- No -->
                    <td class="px-4 py-3 text-center font-medium text-gray-600">
                        {{ $loop->iteration }}
                    </td>

                    <!-- Nama Dosen -->
                    <td class="px-4 py-3 font-medium">{{ $schedule->user->name ?? '-' }}</td>

                    <!-- Mata Kuliah + Kelas -->
                    <td class="px-4 py-3 text-gray-600">
                        {{ $schedule->mata_kuliah_praktikum->nama_mata_kuliah ?? '-' }}
                        ({{ $schedule->kelas->nama_kelas ?? '-' }})
                    </td>

                    <!-- Tanggal -->
                    <td class="px-4 py-3 text-center">
                        {{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->format('d M Y') }}
                    </td>

                    <!-- Jam -->
                    <td class="px-4 py-3 text-center">
                        {{ $schedule->waktu_praktikum }}
                    </td>

                    <!-- Aksi -->
                    <td class="px-4 py-3 text-center">
                        <div class="relative inline-block text-left">
                            <button type="button"
                                class="p-2 rounded-full hover:bg-gray-200 focus:outline-none transition"
                                onclick="toggleDropdown('{{ $schedule->id }}', this)">
                                <i class="bi bi-three-dots-vertical text-gray-600"></i>
                            </button>
                            <div id="dropdown-{{ $schedule->id }}"
                                class="hidden absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg ring-1 ring-gray-200 z-20">
                                <ul class="py-1 text-sm text-gray-700 divide-y divide-gray-100">
                                    <li>
                                        <a href="{{ route('schedulings.show', $schedule->id) }}"
                                            class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                                            <i class="bi bi-eye text-blue-500"></i> Lihat
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('schedulings.edit', $schedule->id) }}"
                                            class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                                            <i class="bi bi-pencil text-yellow-500"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('schedulings.destroy', $schedule->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-gray-50">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-6 italic">Belum ada data jadwal.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <!-- Footer Custom Pagination -->
    <div class="flex flex-col items-center justify-between gap-2 mt-4 md:flex-row">
        <p id="customInfo" class="text-sm text-gray-500"></p>
        <div id="customPagination" class="flex items-center gap-1"></div>
    </div>
</div>

{{-- Sembunyikan pagination bawaan DataTables --}}
<style>
    .dataTables_paginate, .dataTables_info { display: none !important; }
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#schedulesTable').DataTable({
        dom: 'Brtip',
        paging: true, // aktif
        info: true,   // biar page.info() tetap ada
        buttons: [
            { extend: 'csv', exportOptions: { columns: ':visible:not(:last-child)' } },
            { extend: 'excel', exportOptions: { columns: ':visible:not(:last-child)' } },
            {
                extend: 'pdf',
                exportOptions: { columns: ':visible:not(:last-child)' },
                customize: function (doc) {
                    // rata tengah semua kolom di PDF
                    doc.styles.tableHeader.alignment = 'center';
                }
            },
            {
                extend: 'print',
                exportOptions: { columns: ':visible:not(:last-child)' },
                customize: function (win) {
                    $(win.document.body)
                        .css('text-align', 'center') // body rata tengah
                        .find('table')
                        .addClass('compact')
                        .css('text-align', 'center'); // isi tabel rata tengah
                }
            },
            {
                extend: 'colvis',
                text: 'Pilih Kolom',
                columns: ':not(:last-child)',
                collectionLayout: 'fixed two-column',
                postfixButtons: ['colvisRestore']
            }
        ],

        columnDefs: [
            { orderable: false, targets: -1 },
            { searchable: false, targets: -1 }
        ],
        lengthMenu: [[10,20,50,100],[10,20,50,100]],
        pageLength: 10
    });

    // Bind tombol export
    $('#btnCsv').on('click', function(){ table.button('.buttons-csv').trigger(); });
    $('#btnExcel').on('click', function(){ table.button('.buttons-excel').trigger(); });
    $('#btnPdf').on('click', function(){ table.button('.buttons-pdf').trigger(); });
    $('#btnPrint').on('click', function(){ table.button('.buttons-print').trigger(); });

    // Handle Column visibility dropdown
    $('#btnColvis').on('click', function(e){
        e.preventDefault();
        $('#colvisDropdown').toggleClass('hidden');

        // Generate daftar kolom dengan tampilan lebih elegan
        var html = '<ul class="py-2 text-sm text-gray-700">';
        table.columns(':not(:last-child)').every(function(index){
            var column = this;
            var visible = column.visible();
            html += `
                <li>
                    <button data-column="${index}"
                        class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-100 transition rounded">
                        <span>${$(column.header()).text()}</span>
                        ${visible
                            ? '<svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" /></svg>'
                            : ''}
                    </button>
                </li>
            `;
        });
        html += '</ul>';

        $('#colvisDropdown').html(html);
    });

    // Klik tombol = toggle visibility
    $('#colvisDropdown').on('click', 'button[data-column]', function(){
        var index = $(this).data('column');
        var column = table.column(index);

        // toggle visible
        column.visible(!column.visible());

        // refresh isi dropdown biar icon centang update
        $('#btnColvis').trigger('click').trigger('click');
    });

    // Klik di luar = tutup dropdown
    $(document).on('click', function(e){
        if (!$(e.target).closest('#btnColvis, #colvisDropdown').length) {
            $('#colvisDropdown').addClass('hidden');
        }
    });


    // Search & Show Entries
    $('#searchBox').on('input', function() { table.search(this.value).draw(); });
    $('#pageLength').on('change', function() { table.page.len(Number(this.value)).draw(); });

    // Fungsi render custom pagination dengan ellipsis
    function renderCustomPagination() {
        var info = table.page.info();
        var container = $('#customPagination');
        var infoText = `Menampilkan ${info.start + 1} hingga ${info.end} dari ${info.recordsDisplay} entri`;
        $('#customInfo').text(infoText);

        container.empty();

        // Tombol sebelumnya
        container.append(`<button class="px-2 py-1 text-sm border rounded hover:bg-gray-100 ${info.page === 0 ? 'opacity-50 cursor-not-allowed' : ''}"
            ${info.page === 0 ? 'disabled' : ''} data-page="${info.page - 1}">Sebelumnya</button>`);

        // Nomor halaman dengan ellipsis
        var maxVisible = 5; // jumlah maksimal nomor yang ditampilkan sekaligus
        var start = Math.max(0, info.page - Math.floor(maxVisible / 2));
        var end = Math.min(info.pages, start + maxVisible);

        if (end - start < maxVisible) {
            start = Math.max(0, end - maxVisible);
        }

        for (var i = 0; i < info.pages; i++) {
            if (i === 0 || i === info.pages - 1 || (i >= start && i < end)) {
                if (i === info.page) {
                    container.append(`<button class="px-3 py-1 text-sm text-white bg-blue-500 rounded" data-page="${i}">${i+1}</button>`);
                } else {
                    container.append(`<button class="px-2 py-1 text-sm border rounded hover:bg-gray-100" data-page="${i}">${i+1}</button>`);
                }
            } else if (i === start - 1 || i === end) {
                container.append(`<span class="px-2">...</span>`);
            }
        }

        // Tombol berikutnya
        container.append(`<button class="px-2 py-1 text-sm border rounded hover:bg-gray-100 ${info.page === info.pages-1 ? 'opacity-50 cursor-not-allowed' : ''}"
            ${info.page === info.pages-1 ? 'disabled' : ''} data-page="${info.page + 1}">Berikutnya</button>`);
    }

    renderCustomPagination();
    table.on('draw', function() { renderCustomPagination(); });

    // Event klik pagination
    $('#customPagination').on('click', 'button[data-page]', function() {
        var page = $(this).data('page');
        table.page(page).draw('page');
    });

    // Dropdown aksi
    window.toggleDropdown = function(id, btn) {
        var menu = document.getElementById('dropdown-' + id);
        if (!menu) return;
        var isHidden = menu.classList.contains('hidden');
        document.querySelectorAll('[id^="dropdown-"]').forEach(function(el){
            el.classList.add('hidden');
        });
        if (isHidden) { menu.classList.remove('hidden'); }
        else { menu.classList.add('hidden'); }
    };
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative.inline-block.text-left')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(function(el){
                el.classList.add('hidden');
            });
        }
    });
});
</script>
@endpush
