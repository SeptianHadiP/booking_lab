<nav id="navbar" class="flex items-center bg-white dark:bg-gray-800 shadow px-4 py-3">
    <!-- Sidebar Toggle -->
    <button id="toggleSidebar" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Search -->
    <form class="flex items-center ml-auto mr-6 space-x-2">
        <input type="text"
               placeholder="Search here..."
               class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200
                      focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm px-3 py-2" />
        <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M9 17a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
        </button>
    </form>

    <!-- User Dropdown -->
    @auth
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open"
                class="flex items-center text-gray-700 dark:text-gray-200 hover:text-indigo-600 focus:outline-none">
            <span class="mr-2">{{ Auth::user()->name }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false"
             class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-700 rounded-md shadow-lg py-2 z-20">
            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                {{ __('Profile') }}
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
    @endauth
</nav>
