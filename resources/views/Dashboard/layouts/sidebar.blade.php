<!-- resources/views/components/layout3/sidebar.blade.php -->
<div id="sidebar" class="bg-white border-end shadow-sm position-fixed h-100" style="width: 250px;">
    <div class="text-center py-4 border-bottom">
        <!-- <img src="https://ubharajaya.ac.id/wp-content/uploads/2022/07/ubj_nama-copy.png" width="100" alt=""> -->
        <h4 class="text-primary fw-bold mb-0">
            <i class="bi bi-building-fill me-2"></i>Hotel
        </h4>
    </div>
    <ul class="nav flex-column px-3 pt-3">
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center {{ request()->is('dashboard') ? 'active bg-primary text-white rounded' : 'text-dark' }}" href="{{route('dashboard')}}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center {{ request()->is('schedules') || request()->is('schedule-create') ? 'active bg-primary text-white rounded' : 'text-dark' }}" href="{{route('schedule.index')}}"><i class="bi bi-journal-bookmark-fill me-2"></i>Schedules</a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center {{ request()->is('users') || request()->is('user-create') ? 'active bg-primary text-white rounded' : 'text-dark' }}" href="{{route('user.index')}}">
                <i class="bi bi-person-fill me-2"></i>Users
            </a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center text-dark" href="#"><i class="bi bi-door-closed-fill me-2"></i>Rooms</a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center {{ request()->is('roles') || request()->is('role-create') ? 'active bg-primary text-white rounded' : 'text-dark' }}" href="{{route('roles.index')}}">
                <i class="bi bi-people-fill me-2"></i>Roles
            </a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center text-dark" href="#"><i class="bi bi-calendar3 me-2"></i>Calendar</a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center text-dark" href="#"><i class="bi bi-clipboard-data-fill me-2"></i>Attendance Sheet</a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center text-dark" href="#"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i>Sheet Report</a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center text-dark" href="#"><i class="bi bi-cash-stack me-2"></i>Billing</a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center text-dark" href="#"><i class="bi bi-receipt-cutoff me-2"></i>Bill Info</a>
        </li>
    </ul>
</div>
