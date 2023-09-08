@php
    $profil = \App\Models\ProfilInstansi::first();
    if (auth()->check()) {
        $pesanan = \App\Models\Pesanan::where('user_id', auth()->user()->id)
            ->where('status', 0)
            ->first();
    
        if ($pesanan) {
            $notif_keranjang = \App\Models\DetailPesanan::where('id_pesanan', $pesanan->id_pesanan)->count();
        } else {
            $notif_keranjang = 0;
        }
    }
@endphp

<section id="topbar" class="d-flex align-items-center bg-dark">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="social-links align-items-center d-none d-md-flex">
            <a href="mailto:{{ $profil->email }}" class=""><i class="bi bi-envelope"></i> {{ $profil->email }}</a>
            <a class=""><i class="bi bi-telephone"></i> {{ $profil->telepon }}</a>
        </div>
        <div class="social-links align-items-center">
            @if (auth()->check())
                <a href="#" class="" id="logout"><i class="bi bi-box-arrow-left"></i> Logout</a>
            @else
                <a href="/login" class=""><i class="bi bi-box-arrow-in-right"></i> Login</a>
                <a href="/registrasi" class=""><i class="bi bi-person-check"></i> Registrasi Akun</a>
            @endif
            @auth
                <a href="/perumahan/pesanan">
                    <i class="bi bi-cart" style="font-size: 16pt;"></i>
                    @if ($notif_keranjang != 0)
                        <span class="badge bg-info"
                            style="margin-top: -20px;margin-left: -1px;border: 1px solid;">{{ $notif_keranjang }}
                        </span>
                    @else
                    @endif
                </a>
            @endauth
        </div>
    </div>
</section>


<header id="header" class="d-flex align-items-center" style="background-color:rgb(87, 2, 61); ">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo text-light">
            @if ($profil->logo)
                <img src="{{ asset('storage/' . $profil->logo) }}" class="img-fluid d-none d-md-inline">
            @else
                <img src="/assets/img/logo.png" class="img-fluid d-none d-md-inline">
            @endif
            @if ($profil->nama_instansi)
                <span style="font-size: 12pt;font-weight: bolder;">{{ strtoupper($profil->nama_instansi) }}</span>
            @else
                <span style="font-size: 12pt;font-weight: bolder;">PT. MATRIECS CIPTA ANUGERAH</span>
            @endif
        </h1>

        <nav id="navbar" class="navbar text-light">
            <ul>
                <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : ' ' }}" href="/">Beranda</a>
                </li>
                <li>
                    <a class="nav-link scrollto {{ Request::is('perumahan') ? 'active' : ' ' }}"
                        href="/perumahan">Perumahan
                    </a>
                </li>
                @auth
                    <li>
                        <a class="nav-link scrollto {{ Request::is('perumahan/pesanan/history') ? 'active' : ' ' }}"
                            href="/perumahan/pesanan/history">History Pesanan
                        </a>
                    </li>
                @endauth
                {{-- @auth
                    <li class="dropdown"><a href="#"><span>Welcome back,
                                {{ strtoupper(auth()->user()->nama) }}</span>
                            <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a class="nav-link scrollto" href="#" id="dashboard">My Dashboard</a></li>
                            <li><a class="nav-link scrollto" href="#" id="logout">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a class="nav-link scrollto {{ Request::is('administrator') ? 'active' : ' ' }}"
                            href="/administrator">Administrator</a></li>
                @endauth --}}
            </ul>
            <i class="bi bi-list mobile-nav-toggle text-light"></i>
        </nav>
    </div>
</header>

<form action="/logout" method="post" id="formLogout">
    @csrf
</form>

<script>
    $(document).on('click', '#dashboard', function() {
        window.location.href = '/dashboard';
    })
    $(document).on('click', '#logout', function() {
        $('#formLogout').submit();
    })
</script>
