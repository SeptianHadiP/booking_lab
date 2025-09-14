<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'LabSchedule') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- FontAwesome v4 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- DataTables Buttons CSS -->
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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

    <!-- Header (pindah logo ke sini) -->
    <header class="w-full fixed top-0 z-20">
        @include('dashboard.layouts.header')
    </header>

    <!-- Main content wrapper (sidebar + content) -->
    <div id="main-wrapper" class="flex flex-1 pt-[64px]">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white border-r w-[250px] h-[calc(100vh-64px)] overflow-y-auto">
            @include('dashboard.layouts.sidebar')
        </aside>

        <!-- Content -->
        <main class="flex-1 p-4">
            @yield('content')
        </main>
    </div>
</div>

@include('components.alert-toast')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- JSZip & pdfmake -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('scripts')
@stack('scripts')

<script>
    // Toggle sidebar
    const checkbox = document.getElementById('label-check');
    const layout = document.getElementById('layout');
    if (checkbox && layout) {
        checkbox.addEventListener('change', () => {
            layout.classList.toggle('collapsed');
        });
    }

    // Auto hide toast
    document.addEventListener('DOMContentLoaded', function () {
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
