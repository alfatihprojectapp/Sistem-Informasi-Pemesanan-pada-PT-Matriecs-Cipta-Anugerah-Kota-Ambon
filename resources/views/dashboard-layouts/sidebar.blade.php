<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="text-center mt-3 mb-3">
        <img src="/assets/img/favicon.jpg" class="img-fluid" style="width: 150px;border-radius: 20px;">
        <div class="brand-text mt-3 mb-3">
            <h6 class="text-light">PT. MATRIECS CIPTA ANUGERAH</h6>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" style="margin-top: -10px;">

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item nav-active">
                    <a href="/dashboard"
                        class="nav-link {{ Request::is('dashboard') ? 'bg-secondary bg-opacity-50 active active' : '' }}">
                        <i class="nav-icon bi bi-layout-text-sidebar-reverse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/perumahan"
                        class="nav-link {{ Request::is('dashboard/perumahan') ? 'bg-secondary bg-opacity-50 active' : '' }}">
                        <i class="nav-icon bi bi-house"></i>
                        <p>
                            Perumahan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/pesanan-masuk"
                        class="nav-link {{ Request::is('dashboard/pesanan-masuk') ? 'bg-secondary bg-opacity-50 active' : '' }}">
                        <i class="nav-icon bi bi-envelope-check"></i>
                        <p>
                            Pesanan Masuk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/pesanan-batal"
                        class="nav-link {{ Request::is('dashboard/pesanan-batal') ? 'bg-secondary bg-opacity-50 active' : '' }}">
                        <i class="nav-icon bi bi-envelope-slash"></i>
                        <p>
                            Pesanan Batal
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/daftar-pelanggan"
                        class="nav-link {{ Request::is('dashboard/daftar-pelanggan') ? 'bg-secondary bg-opacity-50 active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>
                            Daftar Pelanggan
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/dashboard/profil-instansi"
                        class="nav-link {{ Request::is('dashboard/profil-instansi*') ? 'bg-secondary bg-opacity-50 active' : '' }}">
                        <i class="nav-icon bi bi-info-square"></i>
                        <p>
                            Profil Instansi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/dashboard/users"
                        class="nav-link {{ Request::is('dashboard/users*') ? 'bg-secondary bg-opacity-50 active' : '' }}">
                        <i class="nav-icon bi bi-person-check-fill"></i>
                        <p>
                            Daftar User
                        </p>
                    </a>
                </li>

                <br><br><br><br><br><br><br>

            </ul>
        </nav>

    </div>
</aside>
