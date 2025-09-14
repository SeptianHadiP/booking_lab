@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-1">Daftar Pengguna</h2>
            <p class="text-sm text-gray-500">Kelola semua data pengguna aplikasi</p>
        </div>
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">
            + Tambah User
        </a>
    </div>

    <!-- Export & Column Buttons -->
    <div class="flex flex-wrap gap-2 mb-4">
        <button id="btnCsv" class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50">CSV</button>
        <button id="btnExcel" class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50">Excel</button>
        <button id="btnPdf" class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50">PDF</button>
        <button id="btnPrint" class="px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50">Print</button>

        <!-- Column Visibility Dropdown -->
        <div class="relative inline-block text-left">
            <button id="btnColvis" class="flex items-center gap-1 px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-md shadow-sm hover:bg-blue-50">
                Column visibility
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="colvisDropdown" class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-20"></div>
        </div>
    </div>

    <!-- Toolbar: Search + Filter + Show Entries -->
    <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
        <!-- Search + Filter -->
        <div class="flex items-center gap-2">
            <!-- Search Box -->
            <div class="relative">
                <input id="searchBox" type="text" placeholder="Cari laporan..."
                    class="w-56 pl-10 pr-4 py-2 text-sm text-gray-700 bg-white border rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"/>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.75 3.75a7.5 7.5 0 0012.9 12.9z"/>
                </svg>
            </div>

            <!-- Filter -->
            <div class="flex items-center gap-2 relative">
                <div class="relative inline-block text-left">
                    <button id="btnFilter" class="flex items-center gap-1 px-3 py-2 text-sm text-gray-600 bg-white border rounded-full shadow-sm hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-.447.894l-4 2.5A1 1 0 019 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                        Filter
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Kolom Filter -->
                    <div id="filterDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-20"></div>
                </div>

                <!-- Container Filter Aktif -->
                <div id="activeFilters" class="flex flex-wrap gap-2"></div>
            </div>
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

    <!-- Tabel User -->
        <table id="userTable" class="min-w-full divide-y divide-gray-200 text-sm text-left w-full">
            <thead class="bg-gray-50 text-gray-700 text-center">
                <tr>
                    <th class="px-3 py-2 w-10">No</th>
                    <th class="px-3 py-2">Nama</th>
                    <th class="px-3 py-2">Email</th>
                    <th class="px-3 py-2">Role</th>
                    <th class="px-3 py-2 w-20">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-center">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-3 py-2">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2">{{ $user->name }}</td>
                        <td class="px-3 py-2">{{ $user->email }}</td>
                        <td class="px-3 py-2">
                            @forelse($user->roles as $role)
                                <span class="inline-flex items-center px-2 py-1 rounded-full bg-blue-600 text-white text-xs">{{ $role->name }}</span>
                            @empty
                                <span class="text-gray-400">-</span>
                            @endforelse
                        </td>
                        <td class="px-3 py-2">
                            <div class="relative inline-block text-left">
                                <button onclick="toggleDropdown('user-{{ $user->id }}')" class="inline-flex items-center p-2 rounded-full hover:bg-gray-200 transition">
                                    <i class="fa fa-ellipsis-v text-gray-600"></i>
                                </button>
                                <div id="dropdown-user-{{ $user->id }}" class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg z-20">
                                    <ul class="py-1 text-sm text-gray-700 divide-y divide-gray-100">
                                        <li>
                                            <a href="{{ route('users.show', $user->id) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                                                <i class="fa fa-eye text-blue-500"></i> Lihat
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('users.edit', $user->id) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                                                <i class="fa fa-edit text-yellow-500"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" id="delete-form-{{ $user->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $user->id }}')" class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-gray-50">
                                                    <i class="fa fa-trash"></i> Hapus
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
                        <td colspan="5" class="px-3 py-2 text-gray-400 text-center">Belum ada data pengguna.</td>
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
@endsection

<style>
    .dataTables_paginate,
    .dataTables_info {
        display: none !important;
    }
</style>

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>userTable
    $(document).ready(function() {
        var table = $('#userTable').DataTable({
            dom: 'Brtip',
            paging: true,
            info: true,
            buttons: [
                { extend: 'csv', exportOptions: { columns: ':visible:not(:last-child)' } },
                { extend: 'excel', exportOptions: { columns: ':visible:not(:last-child)' } },
                {
                    extend: 'pdf',
                    exportOptions: { columns: ':visible:not(:last-child)' },
                    customize: function (doc) {
                        doc.styles.tableHeader.alignment = 'center';
                        doc.content[1].layout = {
                            hLineWidth: function(i, node) { return 0.5; },
                            vLineWidth: function(i, node) { return 0.5; },
                            hLineColor: function(i, node) { return '#000'; },
                            vLineColor: function(i, node) { return '#000'; },
                            paddingLeft: function(i, node) { return 4; },
                            paddingRight: function(i, node) { return 4; },
                            paddingTop: function(i, node) { return 2; },
                            paddingBottom: function(i, node) { return 2; }
                        };
                        // Hanya kolom "No" (index 0) yang rata tengah
                        doc.content[1].table.body.forEach(function(row, rowIndex){
                            if(rowIndex > 0){ // skip header
                                row[0].alignment = 'center';
                            }
                        });
                    }
                },
                {
                    extend: 'print',
                    exportOptions: { columns: ':visible:not(:last-child)' },
                    customize: function (win) {
                        $(win.document.body).find('table')
                            .css('border-collapse','collapse')
                            .css('width','100%')
                            .find('th, td')
                            .css('border','1px solid #000')
                            .css('padding','4px');
                        // Hanya kolom "No" rata tengah
                        $(win.document.body).find('table tr').each(function(){
                            $(this).find('td:first, th:first').css('text-align','center');
                        });
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

        // Search & Show Entries
        $('#searchBox').on('input', function() { table.search(this.value).draw(); });
        $('#pageLength').on('change', function() { table.page.len(Number(this.value)).draw(); });

        // Bind tombol export
        $('#btnCsv').on('click', function(){ table.button('.buttons-csv').trigger(); });
        $('#btnExcel').on('click', function(){ table.button('.buttons-excel').trigger(); });
        $('#btnPdf').on('click', function(){ table.button('.buttons-pdf').trigger(); });
        $('#btnPrint').on('click', function(){ table.button('.buttons-print').trigger(); });

        /* ================== column visibility ================== */
        // Handle Column visibility dropdown
        $('#btnColvis').on('click', function(e){
            e.preventDefault();
            $('#colvisDropdown').toggleClass('hidden');

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
            column.visible(!column.visible());
            $('#btnColvis').trigger('click').trigger('click');
        });

        // Klik di luar = tutup column visibility
        $(document).on('click', function(e){
            if (!$(e.target).closest('#btnColvis, #colvisDropdown').length) {
                $('#colvisDropdown').addClass('hidden');
            }
        });
        /* ================== END column visibility ================== */

        /* ================== FILTER ================== */
        let activeFilters = {}; // simpan filter aktif {colIndex: val}

        // Klik tombol Filter → tampilkan daftar kolom
        $('#btnFilter').on('click', function(e){
            e.preventDefault();
            $('#filterDropdown').toggleClass('hidden');

            let html = '<ul class="py-2 text-sm text-gray-700">';
            table.columns().every(function(index){
                if(index === 0 || index === table.columns().count()-1) return; // skip No & Aksi
                const isActive = $(`#filter-col-${index}`).length > 0;
                html += `
                    <li>
                        <button data-col="${index}"
                            class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-100 transition rounded">
                            <span>${$(this.header()).text()}</span>
                            ${isActive
                                ? '<svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" /></svg>'
                                : '<span class="w-4 h-4"></span>'}
                        </button>
                    </li>
                `;
            });
            html += '</ul>';
            $('#filterDropdown').html(html);
        });

        // Klik item list → toggle filter aktif
        $('#filterDropdown').on('click', 'button[data-col]', function(){
            let colIndex = $(this).data('col');

            if($(`#filter-col-${colIndex}`).length === 0){
                // generate nilai unik
                let values = Array.from(new Set(table.column(colIndex).data().toArray())).sort();

                // buat dropdown filter baru
                let $dropdown = $(`
                    <div id="filter-col-${colIndex}">
                        <select class="px-4 py-2 text-sm text-gray-600 bg-white border rounded-full shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                        </select>
                    </div>
                `);
                let $select = $dropdown.find('select');

                // option default
                $select.append(`<option value="">-- Semua ${$(table.column(colIndex).header()).text()} --</option>`);
                values.forEach(function(val){
                    $select.append(`<option value="${val}">${val}</option>`);
                });

                $('#activeFilters').append($dropdown);

                // event pilih nilai
                $select.on('change', function(){
                    let val = $(this).val();
                    if(val){
                        activeFilters[colIndex] = val;
                        table.column(colIndex).search(val).draw();
                    } else {
                        delete activeFilters[colIndex];
                        table.column(colIndex).search('').draw();
                    }
                });
            } else {
                // hapus filter jika di-toggle off
                delete activeFilters[colIndex];
                table.column(colIndex).search('').draw();
                $(`#filter-col-${colIndex}`).remove();
            }

            // refresh dropdown supaya ikon centang update
            $('#btnFilter').trigger('click').trigger('click');
        });

        // Klik di luar → tutup dropdown list kolom
        $(document).on('click', function(e){
            if(!$(e.target).closest('#btnFilter, #filterDropdown').length){
                $('#filterDropdown').addClass('hidden');
            }
        });
        /* ================== END FILTER ================== */

        /* ================== PAGINATION ================== */
        // Custom pagination
        function renderCustomPagination() {
            var info = table.page.info();
            var container = $('#customPagination');
            var infoText = `Menampilkan ${info.start + 1} hingga ${info.end} dari ${info.recordsDisplay} entri`;
            $('#customInfo').text(infoText);
            container.empty();

            container.append(`<button class="px-2 py-1 text-sm border rounded hover:bg-gray-100 ${info.page === 0 ? 'opacity-50 cursor-not-allowed' : ''}"
                ${info.page === 0 ? 'disabled' : ''} data-page="${info.page - 1}">Sebelumnya</button>`);

            var maxVisible = 5;
            var start = Math.max(0, info.page - Math.floor(maxVisible / 2));
            var end = Math.min(info.pages, start + maxVisible);
            if (end - start < maxVisible) start = Math.max(0, end - maxVisible);

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

            container.append(`<button class="px-2 py-1 text-sm border rounded hover:bg-gray-100 ${info.page === info.pages-1 ? 'opacity-50 cursor-not-allowed' : ''}"
                ${info.page === info.pages-1 ? 'disabled' : ''} data-page="${info.page + 1}">Berikutnya</button>`);
        }

        renderCustomPagination();
        table.on('draw', function() { renderCustomPagination(); });

        $('#customPagination').on('click', 'button[data-page]', function() {
            var page = $(this).data('page');
            table.page(page).draw('page');
        });
        /* ================== END PAGINATION ================== */

        // Dropdown aksi
        window.toggleDropdown = function(id, btn) {
            var menu = document.getElementById('dropdown-' + id);
            if (!menu) return;
            var isHidden = menu.classList.contains('hidden');
            document.querySelectorAll('[id^="dropdown-"]').forEach(function(el){
                el.classList.add('hidden');
            });
            if (isHidden) menu.classList.remove('hidden');
            else menu.classList.add('hidden');
        };
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative.inline-block.text-left')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(function(el){
                    el.classList.add('hidden');
                });
            }
        });
    });

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

    window.toggleDropdown = function(id) {
        const menu = document.getElementById('dropdown-' + id);
        const isHidden = menu.classList.contains('hidden');
        document.querySelectorAll('[id^="dropdown-user-"]').forEach(el => el.classList.add('hidden'));
        if(isHidden) menu.classList.remove('hidden');
    };
    document.addEventListener('click', function(e){
        if(!e.target.closest('[id^="dropdown-user-"], button')) {
            document.querySelectorAll('[id^="dropdown-user-"]').forEach(el => el.classList.add('hidden'));
        }
    });
</script>
@endpush
