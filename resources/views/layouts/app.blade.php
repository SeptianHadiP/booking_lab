<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'LabSchedule') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- TailwindCSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Chart.js (opsional) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- DataTables CSS (versi default tanpa bootstrap) --}}
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }
        #sidebar {
            width: 250px;
            transition: all 0.3s;
        }
        #navbar, main {
            transition: all 0.3s;
            margin-left: 250px;
        }
        .collapsed #sidebar {
            margin-left: -250px;
        }
        .collapsed #navbar,
        .collapsed main {
            margin-left: 0;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900">

<div class="flex" id="layout">
    {{-- Sidebar --}}
    @include('dashboard.layouts.sidebar')

    <div class="flex-1 flex flex-col min-h-screen">
        {{-- Header/Navbar --}}
        @include('dashboard.layouts.header')

        {{-- Main Content --}}
        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>

{{-- Toastr Alert --}}
@include('components.alert-toast')

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

{{-- DataTables JS --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

{{-- Toastr JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- SweetAlert2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('scripts')
@stack('scripts')

{{-- Sidebar Toggle --}}
<script>
    document.getElementById('toggleSidebar')?.addEventListener('click', function () {
        document.getElementById('layout')?.classList.toggle('collapsed');
    });
</script>

{{-- Auto hide toast --}}
@push('scripts')
<script>
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
@endpush

</body>
</html>
