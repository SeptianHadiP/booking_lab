@extends('dashboard.layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Laporan Praktikum</h2>
            <p class="text-sm text-gray-500">Kelola semua laporan praktikum yang telah ditambahkan</p>
        </div>
        <x-button.can permission="buat.laporan-praktek">
            <a href="{{ route('laprak.create') }}"
               class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700 transition">
                + Tambah Laporan
            </a>
        </x-button.can>
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

    <!-- Table -->
    <table id="laprakTable" class="w-full text-sm text-gray-700 border-collapse">
        <thead class="bg-gray-100 text-xs uppercase text-gray-700 tracking-wide shadow-sm">
            <tr>
                <th class="px-4 py-3 text-center border">No</th>
                <th class="px-4 py-3 text-center border">Nama Pengunggah</th>
                <th class="px-4 py-3 text-center border">Mata Kuliah</th>
                <th class="px-4 py-3 text-center border">Kelas</th>
                <th class="px-4 py-3 text-center border">Tahun Ajaran</th>
                <th class="px-4 py-3 text-center border">File Laporan</th>
                <th class="px-4 py-3 text-center border">File Nilai</th>
                <th class="px-4 py-3 text-center border">Status Sertifikasi</th>
                <th class="px-4 py-3 text-center border">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($lapraks as $laprak)
            <tr class="even:bg-gray-50 hover:bg-blue-50 transition-colors">
                <td class="px-4 py-3 text-center font-medium text-gray-600 border">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 font-medium border">{{ $laprak->user->name ?? '-' }}</td>
                <td class="px-4 py-3 text-gray-600 border">{{ $laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? '-' }}</td>
                <td class="px-4 py-3 text-gray-600 border">{{ $laprak->kelas->nama_kelas ?? '-' }}</td>
                <td class="px-4 py-3 text-left border">{{ $laprak->semester->tahun_ajar ?? '-' }}</td>
                <td class="px-4 py-3 text-gray-600 border">
                    @if($laprak->laporan_file)
                        <a href="{{ asset('storage/'.$laprak->laporan_file) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Laporan</a>
                    @else - @endif
                </td>
                <td class="px-4 py-3 text-gray-600 border">
                    @if($laprak->nilai_file)
                        <a href="{{ asset('storage/'.$laprak->nilai_file) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Nilai</a>
                    @else - @endif
                </td>
                <td class="px-4 py-3 text-center border">
                    @php
                        $tahunAjaran = \Illuminate\Support\Str::slug($laprak->semester->tahun_ajar ?? date('Y'));
                        $mataKuliah  = \Illuminate\Support\Str::slug($laprak->mata_kuliah_praktikum->nama_mata_kuliah ?? 'mata-kuliah');
                        $kelas       = \Illuminate\Support\Str::slug($laprak->kelas->nama_kelas ?? 'kelas');

                        $basePath = "generated_certificates/{$tahunAjaran}/{$mataKuliah}/{$kelas}";
                        $hasCertificates = \Illuminate\Support\Facades\Storage::disk('public')->exists($basePath)
                            && count(\Illuminate\Support\Facades\Storage::disk('public')->files($basePath)) > 0;
                    @endphp

                    @if($hasCertificates)
                        <a href="{{ route('laprak.certificates', $laprak->id) }}" target="_blank"
                        class="inline-flex items-center gap-2 px-3 py-1.5 border border-purple-600 text-purple-600 rounded hover:bg-purple-50 transition text-sm">
                            <i class="fa fa-certificate"></i> Lihat Sertifikat
                        </a>
                    @else
                        <span class="text-gray-400 text-sm">Belum ada sertifikat</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-center border">
                    <div class="relative inline-block text-left">
                        <button type="button" class="p-2 rounded-full hover:bg-gray-200 focus:outline-none transition"
                            onclick="toggleDropdown('{{ $laprak->id }}', this)">
                            <i class="bi bi-three-dots-vertical text-gray-600"></i>
                        </button>
                        <div id="dropdown-{{ $laprak->id }}" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg ring-1 ring-gray-200 z-20">
                            <ul class="py-1 text-sm text-gray-700 divide-y divide-gray-100">
                                <li>
                                    <a href="{{ route('laprak.show', $laprak->id) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                                        <i class="bi bi-eye text-blue-500"></i> Lihat
                                    </a>
                                </li>
                                @can('edit laprak', $laprak)
                                <li>
                                    <a href="{{ route('laprak.edit', $laprak->id) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                                        <i class="bi bi-pencil text-yellow-500"></i> Edit laporan
                                    </a>
                                </li>
                                @endcan
                                @hasPermission('create laprak')
                                <li>
                                    <a href="{{ route('certificate.create', $laprak->id) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                                        <i class="bi bi-pencil text-yellow-500"></i> Create Sertifikat
                                    </a>
                                </li>
                                @endhasPermission
                                @hasPermission('delete laprak')
                                <li>
                                    <form action="{{ route('laprak.destroy', $laprak->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-gray-50">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </li>
                                @endhasPermission
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center text-gray-500 py-6 italic border">
                    Belum ada data laporan praktikum.
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
@endsection

<style>
    .dataTables_paginate,
    .dataTables_info {
        display: none !important;
    }
</style>

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#laprakTable').DataTable({
            dom: 'Brtip',
            paging: true,
            info: true,
            buttons: [
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(:last-child)',
                        format: {
                            body: function (data, row, column, node) {
                                if ($(node).find('a').length || (typeof data === 'string' && data.startsWith('http'))) {
                                    return 'Lihat File';
                                }
                                return data;
                            }
                        }
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible:not(:last-child)',
                        format: {
                            body: function (data, row, column, node) {
                                if ($(node).find('a').length || (typeof data === 'string' && data.startsWith('http'))) {
                                    return 'Lihat File';
                                }
                                return data;
                            }
                        }
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible:not(:last-child)',
                        format: {
                            body: function (data, row, column, node) {
                                if ($(node).find('a').length) {
                                    return $(node).find('a').attr('href'); // ambil URL aslinya
                                }
                                if (typeof data === 'string' && data.startsWith('http')) {
                                    return data;
                                }
                                return data;
                            }
                        }
                    },
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

                        // Ubah URL jadi link "Lihat File"
                        doc.content[1].table.body.forEach(function(row, rowIndex){
                            row.forEach(function(cell, colIndex){
                                if (typeof cell === 'string' && cell.startsWith('http')) {
                                    row[colIndex] = {
                                        text: 'Lihat File',
                                        link: cell,
                                        color: 'blue',
                                        decoration: 'underline'
                                    };
                                }
                            });
                            if(rowIndex > 0){
                                row[0].alignment = 'center';
                            }
                        });
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:not(:last-child)',
                        format: {
                            body: function (data, row, column, node) {
                                if ($(node).find('a').length) {
                                    return $(node).find('a').attr('href'); // kirim URL
                                }
                                if (typeof data === 'string' && data.startsWith('http')) {
                                    return data;
                                }
                                return data;
                            }
                        }
                    },
                    customize: function (win) {
                        $(win.document.body).find('table')
                            .css('border-collapse','collapse')
                            .css('width','100%')
                            .find('th, td')
                            .css('border','1px solid #000')
                            .css('padding','4px');

                        // Kolom "No" rata tengah
                        $(win.document.body).find('table tr').each(function(){
                            $(this).find('td:first, th:first').css('text-align','center');
                        });

                        // Ganti URL panjang jadi link singkat
                        $(win.document.body).find('td').each(function(){
                            var text = $(this).text();
                            if (text.startsWith('http')) {
                                $(this).html('<a href="' + text + '" target="_blank">Lihat File</a>');
                            }
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

    /* ================== ALERTS ================== */
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
