<nav id="navbar" class="navbar navbar-expand navbar-light bg-light shadow-sm px-4">
    <button id="toggleSidebar" class="btn btn-outline-primary me-3">
        <i class="bi bi-list"></i>
    </button>

    <form class="d-flex ms-auto me-4" role="search">
        <input class="form-control me-2" type="search" placeholder="Search here..." />
        <button class="btn btn-success" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <!-- User Dropdown -->
    @auth
    <div class="dropdown">
        <button class="btn btn-white dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    {{ __('Profile') }}
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </li>
        </ul>
    </div>
    @endauth
</nav>
