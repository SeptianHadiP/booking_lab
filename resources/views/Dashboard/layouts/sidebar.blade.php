<!-- Sidebar -->
<div class="fixed left-0  h-screen w-64 bg-white shadow flex flex-col">
    <!-- Navigation -->
    <ul class="flex flex-col px-3 pt-4 flex-1 overflow-y-auto">
        <li class="mb-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center px-3 py-2 rounded transition
               {{ request()->is('dashboard') ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100' }}">
                <i class="bi bi-speedometer2 mr-2 text-lg"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <x-button.can permission="index.penjadwalan">
            <li class="mb-1">
                <a href="{{ route('scheduling.index') }}"
                class="flex items-center px-3 py-2 rounded transition
                {{ request()->is('schedulings*') ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100' }}">
                    <i class="bi bi-journal-bookmark-fill mr-2 text-lg"></i>
                    <span>Penjadwalan</span>
                </a>
            </li>
        </x-button.can>

        <x-button.can permission="index.pengguna">
            <li class="mb-1">
                <a href="{{ route('users.index') }}"
                   class="flex items-center px-3 py-2 rounded transition
                   {{ request()->is('users*') ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100' }}">
                    <i class="bi bi-person-fill mr-2 text-lg"></i>
                    <span>Pengguna</span>
                </a>
            </li>
        </x-button.can>

        <x-button.can permission="index.peran">
            <li class="mb-1">
                <a href="{{ route('roles.index') }}"
                   class="flex items-center px-3 py-2 rounded transition
                   {{ request()->is('roles*') ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100' }}">
                    <i class="bi bi-people-fill mr-2 text-lg"></i>
                    <span>Peran</span>
                </a>
            </li>
        </x-button.can>
        <x-button.can permission="index.laporan-praktek">
            <li class="mb-1">
                <a href="{{ route('laprak.index') }}"
                   class="flex items-center px-3 py-2 rounded transition
                   {{ request()->is('laporan-praktikum*') ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100' }}">
                    <i class="bi bi-clipboard-data-fill mr-2 text-lg"></i>
                    <span>Laporan Pratikum</span>
                </a>
            </li>
        </x-button.can>
        <x-button.can permission="index.templat">
            <li class="mb-1">
                <a href="{{ route('template.index') }}"
                   class="flex items-center px-3 py-2 rounded transition
                   {{ request()->is('template*') ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100' }}">
                    <i class="bi bi-clipboard-data-fill mr-2 text-lg"></i>
                    <span>Template Sertifikat</span>
                </a>
            </li>
        </x-button.can>
    </ul>
</div>
