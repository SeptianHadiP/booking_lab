<!-- resources/views/dashboard/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'LabSchedule') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- FullCalendar CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">

    {{-- Custom CSS --}}
    <style>
        /* Sidebar transition */
        #sidebar { width: 250px; transition: margin-left 0.3s ease; }
        #main-wrapper { transition: margin-left 0.3s ease; }
        .collapsed #sidebar { margin-left: -250px; }
        .collapsed #main-wrapper { margin-left: 0; }

        /* Hide DataTables default buttons */
        .dt-buttons { display: none !important; }
    </style>
</head>
<body class="bg-gray-100">
<div id="layout" class="min-h-screen flex flex-col">

    {{-- Header --}}
    <header class="w-full fixed top-0 z-50">
        @include('dashboard.layouts.header')
    </header>

    {{-- Main Wrapper --}}
    <div id="main-wrapper" class="flex flex-1 pt-[64px]">

        {{-- Sidebar --}}
        <aside id="sidebar"
               class="bg-white border-r w-[250px] h-[calc(100vh-64px)]
                      overflow-y-auto
                      fixed md:static top-[64px] left-0 transform -translate-x-full md:translate-x-0
                      transition-transform duration-300 ease-in-out z-30">
            @include('dashboard.layouts.sidebar')
        </aside>

        {{-- Overlay untuk mobile --}}
        <div id="sidebar-overlay"
             class="fixed inset-0 bg-black bg-opacity-50 hidden z-20 md:hidden"></div>

        {{-- Content --}}
        <main class="flex-1 p-4">
            @yield('content')
        </main>
    </div>
</div>

{{-- ======================= SCRIPTS ======================= --}}

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Bootstrap Bundle (Popper.js included) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- DataTables JS --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

{{-- Export Support (Excel/PDF) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

{{-- Toastr JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- SweetAlert2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- FullCalendar JS --}}
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

{{-- Custom Components --}}
@include('components.alert-toast')

{{-- Stack untuk halaman tertentu --}}
@stack('scripts')

{{-- Custom Script --}}
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const toggleBtn = document.getElementById('label-check');

    // Toggle sidebar
    if (toggleBtn) {
        toggleBtn.addEventListener('change', () => {
            if (window.innerWidth < 768) {
                // Mobile
                if (toggleBtn.checked) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            } else {
                // Desktop
                document.getElementById('layout').classList.toggle('collapsed');
            }
        });
    }

    // Klik overlay untuk close
    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            if (toggleBtn) toggleBtn.checked = false;
        });
    }

    // Auto hide toast
    document.addEventListener('DOMContentLoaded', () => {
        const toast = document.getElementById('alert-toast');
        if (toast) {
            setTimeout(() => {
                toast.classList.remove('show');
                toast.classList.add('hide');
            }, 4000);
        }
    });
</script>
</body>
</html>
    