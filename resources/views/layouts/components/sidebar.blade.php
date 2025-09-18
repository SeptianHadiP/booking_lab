<div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-white dark:bg-gray-900 border-r shadow-sm">
    <!-- Logo -->
    <div class="flex items-center justify-center py-6 border-b">
        <img src="https://ubharajaya.ac.id/wp-content/uploads/2022/07/ubj_nama-copy.png" alt="Logo" class="h-10">
    </div>

    <!-- Nav Items -->
    <ul class="mt-4 space-y-1 px-3">
        <li>
            <a href="{{ route('dashboard') }}"
               class="flex items-center px-3 py-2 rounded-md font-medium transition
               {{ request()->is('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' }}">
                <i class="bi bi-speedometer2 mr-2"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('scheduling.index') }}"
               class="flex items-center px-3 py-2 rounded-md font-medium transition
               {{ request()->is('schedulings') || request()->is('create-schedulings') || request()->is('create-documentation')
                    ? 'bg-blue-600 text-white'
                    : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' }}">
                <i class="bi bi-journal-bookmark-fill mr-2"></i> Schedulings
            </a>
        </li>

        <x-button.can permission="read documentation">
            <li>
                <a href="{{ route('documentation.index') }}"
                   class="flex items-center px-3 py-2 rounded-md font-medium transition
                   {{ request()->is('documentation') || request()->is('create-documentation')
                        ? 'bg-blue-600 text-white'
                        : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' }}">
                    <i class="bi bi-clipboard-data-fill mr-2"></i> Document
                </a>
            </li>
        </x-button.can>

        <x-button.can permission="read user">
            <li>
                <a href="{{ route('users.index') }}"
                   class="flex items-center px-3 py-2 rounded-md font-medium transition
                   {{ request()->is('users') || request()->is('users-create')
                        ? 'bg-blue-600 text-white'
                        : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' }}">
                    <i class="bi bi-person-fill mr-2"></i> Users
                </a>
            </li>
        </x-button.can>

        <x-button.can permission="read role">
            <li>
                <a href="{{ route('roles.index') }}"
                   class="flex items-center px-3 py-2 rounded-md font-medium transition
                   {{ request()->is('roles') || request()->is('create-role')
                        ? 'bg-blue-600 text-white'
                        : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' }}">
                    <i class="bi bi-people-fill mr-2"></i> Roles
                </a>
            </li>
        </x-button.can>

        <li>
            <a href="{{ route('laprak.create') }}"
               class="flex items-center px-3 py-2 rounded-md font-medium transition
               {{ request()->is('laporan-praktikum') || request()->is('laprak.create')
                    ? 'bg-blue-600 text-white'
                    : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' }}">
                <i class="bi bi-file-earmark-bar-graph-fill mr-2"></i> Laporan Praktikum
            </a>
        </li>

        <li>
            <a href="{{ route('certificate.create') }}"
               class="flex items-center px-3 py-2 rounded-md font-medium transition
               {{ request()->is('certificate') || request()->is('certificate.create')
                    ? 'bg-blue-600 text-white'
                    : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' }}">
                <i class="bi bi-file-earmark-bar-graph-fill mr-2"></i> Certificate
            </a>
        </li>

        <li>
            <a href="{{ route('template.index') }}"
               class="flex items-center px-3 py-2 rounded-md font-medium transition
               {{ request()->is('template') || request()->is('template.create')
                    ? 'bg-blue-600 text-white'
                    : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' }}">
                <i class="bi bi-file-earmark-bar-graph-fill mr-2"></i> Template
            </a>
        </li>
    </ul>
</div>
