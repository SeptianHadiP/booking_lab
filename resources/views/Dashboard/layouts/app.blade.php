<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LabSchedule | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
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

{{-- Script untuk toggle sidebar --}}
<!-- @yield('scripts') -->
<script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        document.getElementById('layout').classList.toggle('collapsed');
    });
</script>
</body>
</html>
