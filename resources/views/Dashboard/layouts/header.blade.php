<!-- resources/views/dashboard/layouts/header.blade.php -->
<nav class="bg-white shadow-sm flex items-center h-16 px-4 z-30 w-full relative justify-between">
    <!-- Kiri: Hamburger + Logo -->
    <div class="flex items-center gap-4">
        <!-- Toggle Sidebar -->
        <div>
            <input id="sidebarToggle" type="checkbox" class="hidden peer">
            <label for="sidebarToggle" class="relative block w-6 h-6 cursor-pointer">
                <span class="absolute top-1 w-[22px] h-[3px] bg-violet-600 rounded transition-all duration-300 peer-checked:rotate-[35deg] peer-checked:scale-x-55 peer-checked:translate-x-[13px] peer-checked:-translate-y-[2px]"></span>
                <span class="absolute top-1/2 w-[22px] h-[3px] bg-violet-600 rounded -translate-y-1/2 transition-all duration-300 peer-checked:w-[18px]"></span>
                <span class="absolute bottom-1 w-[22px] h-[3px] bg-violet-600 rounded transition-all duration-300 peer-checked:rotate-[-35deg] peer-checked:scale-x-55 peer-checked:translate-x-[13px] peer-checked:translate-y-[2px]"></span>
            </label>
        </div>

        <!-- Logo -->
        <a href="/" class="flex items-center">
            <img src="https://ubharajaya.ac.id/wp-content/uploads/2022/07/ubj_nama-copy.png"
                 class="h-8 w-auto" alt="UBH Logo">
        </a>
    </div>

    <!-- Tengah: Search -->
    <div class="flex-1 max-w-md mx-4">
        <div class="relative">
            <input type="text" placeholder="Search here..."
                   class="w-full border border-gray-300 rounded-full pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"/>
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <i class="bi bi-search"></i>
            </span>
        </div>
    </div>

    <!-- Kanan: User Dropdown -->
    @auth
    <div class="relative ml-4">
        <button id="userDropdown"
                class="flex items-center bg-white rounded-full shadow px-3 py-1 space-x-2 hover:shadow-md transition"
                type="button">
            <img class="w-8 h-8 rounded-full ring-1 ring-gray-300" src="https://i.pravatar.cc/150?img=3" alt="Avatar">
            <span class="font-medium text-gray-700">{{ Auth::user()->name }}</span>
            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06-.02L10 10.88l3.71-3.69a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01-.02-1.06z"
                      clip-rule="evenodd"/>
            </svg>
        </button>

        <ul id="dropdownMenu"
            class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden">
            <li>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 transition">
                    Profile
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 transition">
                        Log Out
                    </button>
                </form>
            </li>
        </ul>
    </div>
    @endauth
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('userDropdown');
        const menu = document.getElementById('dropdownMenu');

        button?.addEventListener('click', () => {
            menu?.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (menu && button && !button.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>
