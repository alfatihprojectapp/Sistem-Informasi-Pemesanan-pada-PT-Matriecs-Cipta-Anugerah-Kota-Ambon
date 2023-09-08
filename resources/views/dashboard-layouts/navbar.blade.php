<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="bi bi-list"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link"><i class="bi bi-house-fill"></i> Beranda</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Welcome, {{ strtoupper(auth()->user()->nama) }}
                @if (!auth()->user()->foto)
                    <img style="width: 40px; height: 40px; border: 2px solid white; margin-top: -8px;border: 2px solid rgba(51, 51, 51,0.5);"
                        class="rounded-circle" src="/assets/img/avatar.png">
                @else
                    <img style="width: 40px; height: 40px; border: 2px solid white; margin-top: -8px;border: 2px solid rgba(51, 51, 51,0.5);"
                        class="rounded-circle" src="{{ asset('storage/' . auth()->user()->foto) }}">
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-dark dropdown-menu-lg dropdown-menu-right">
                {{-- <a href="/dashboard/user/profil" class="dropdown-item">
                    <i class="bi bi-person-fill mr-2"></i>
                    Lihat Profil
                </a> --}}
                {{-- <hr class="text-secondary"> --}}
                <div class="dropdown-divider"></div>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item link">
                        <i class="bi bi-box-arrow-right" style="margin-left: 3px;"></i> <span
                            style="font-size: 11pt;margin-left: 5px;">Logout</span>
                    </button>
                </form>
            </div>
        </li>

    </ul>
</nav>
