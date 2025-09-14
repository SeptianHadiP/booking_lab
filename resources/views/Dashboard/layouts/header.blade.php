<nav class="bg-white shadow-sm flex items-center h-16 px-4 z-30 w-full relative justify-between">
    <!-- Kiri: Hamburger + Logo -->
    <div class="flex items-center gap-4">
        <!-- Toggle Sidebar -->
        <div class="relative">
            <input class="label-check" id="label-check" type="checkbox">
            <label for="label-check" class="hamburger-label relative block">
                <div class="line1 absolute"></div>
                <div class="line2 absolute"></div>
                <div class="line3 absolute"></div>
            </label>
        </div>

        <!-- Logo -->
        <div class="flex items-center">
            <img src="https://ubharajaya.ac.id/wp-content/uploads/2022/07/ubj_nama-copy.png"
                 class="h-8 w-auto" alt="UBH Logo">
        </div>
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
                type="button"
                onclick="document.getElementById('dropdownMenu').classList.toggle('hidden')">
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


<style>
.label-check { display: none; }
.hamburger-label { width: 20px; height: 20px; cursor: pointer; position: relative; }
.hamburger-label div {
  width: 22px; height: 3px; background-color: blueviolet; position: absolute; left: 0;
}
.line1 { top: 2px; transition: all .3s; }
.line2 { top: 50%; transform: translateY(-50%); transition: all .3s; }
.line3 { bottom: 1px; transition: all .3s; }
#label-check:checked + .hamburger-label .line1 {
  transform: rotate(35deg) scaleX(.55) translate(13px, -1.5px); border-radius: 50px 50px 50px 0;
}
#label-check:checked + .hamburger-label .line3 {
  transform: rotate(-35deg) scaleX(.55) translate(13px, 1px); border-radius: 0 50px 50px 50px;
}
#label-check:checked + .hamburger-label .line2 { border-radius: 50px; width: 18px; }
</style>

<script>
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = document.getElementById('userDropdown');
        if (dropdown && button && !button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
