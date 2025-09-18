<!-- resources/views/dashboard/layouts/sidebar.blade.php -->
<div class="h-full flex flex-col">
    <!-- Navigation -->
    <ul class="flex flex-col px-3 pt-4 flex-1 overflow-y-auto space-y-1">
        @php
            $linkBase = 'flex items-center px-3 py-2 rounded transition';
            $active   = 'bg-blue-500 text-white';
            $inactive = 'text-gray-800 hover:bg-blue-100';
        @endphp

        <!-- Dashboard -->
        <li>
            <a href="{{ route('dashboard') }}"
               class="{{ $linkBase }} {{ request()->is('dashboard') ? $active : $inactive }}">
                <i class="bi bi-speedometer2 mr-2 text-lg"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Penjadwalan -->
        <x-button.can permission="index.penjadwalan">
            <li>
                <a href="{{ route('scheduling.index') }}"
                   class="{{ $linkBase }} {{ request()->is('schedulings*') ? $active : $inactive }}">
                    <i class="bi bi-calendar-event-fill mr-2 text-lg"></i>
                    <span>Penjadwalan</span>
                </a>
            </li>
        </x-button.can>

        <!-- Laporan Praktikum -->
        <x-button.can permission="index.laporan-praktek">
            <li>
                <a href="{{ route('laprak.index') }}"
                   class="{{ $linkBase }} {{ request()->is('laporan-praktikum*') ? $active : $inactive }}">
                    <i class="bi bi-file-earmark-text-fill mr-2 text-lg"></i>
                    <span>Laporan Praktikum</span>
                </a>
            </li>
        </x-button.can>

        <!-- Template Sertifikat -->
        <x-button.can permission="index.templat">
            <li>
                <a href="{{ route('template.index') }}"
                   class="{{ $linkBase }} {{ request()->is('template*') ? $active : $inactive }}">
                    <i class="bi bi-file-medical-fill mr-2 text-lg"></i>
                    <span>Template Sertifikat</span>
                </a>
            </li>
        </x-button.can>

        <!-- Pengguna -->
        <x-button.can permission="index.pengguna">
            <li>
                <a href="{{ route('users.index') }}"
                   class="{{ $linkBase }} {{ request()->is('users*') ? $active : $inactive }}">
                    <i class="bi bi-person-fill mr-2 text-lg"></i>
                    <span>Pengguna</span>
                </a>
            </li>
        </x-button.can>

        <!-- Peran -->
        <x-button.can permission="index.peran">
            <li>
                <a href="{{ route('roles.index') }}"
                   class="{{ $linkBase }} {{ request()->is('roles*') ? $active : $inactive }}">
                    <i class="bi bi-people-fill mr-2 text-lg"></i>
                    <span>Peran</span>
                </a>
            </li>
        </x-button.can>
    </ul>
</div>
