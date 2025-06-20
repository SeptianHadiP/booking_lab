<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LabSchedule | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- FontAwesome v4 --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{-- DataTables CSS --}}
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    {{-- Chart.js (optional) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
<body>
<div class="d-flex" id="layout">
    @include('dashboard.layouts.sidebar')

    <div class="flex-grow-1">
        @include('dashboard.layouts.header')

        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

{{-- Bootstrap Bundle (includes Popper.js) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- DataTables JS --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

{{-- Script tambahan dari view --}}
@stack('scripts')

<script>
    document.getElementById('toggleSidebar')?.addEventListener('click', function () {
        document.getElementById('layout')?.classList.toggle('collapsed');
    });
</script>
</body>
</html>
