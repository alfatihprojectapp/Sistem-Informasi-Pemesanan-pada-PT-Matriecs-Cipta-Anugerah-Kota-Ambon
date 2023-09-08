@php
    $profil = \App\Models\ProfilInstansi::first();
@endphp

<title>{{ ucwords($profil->nama_instansi) }}</title>

<div>
    <section id="hero" class="d-flex align-items-top">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <img src="/assets/img/logo.png" class="img-fluid logo">
            <h2>{!! $profil->deskripsi !!}</h2>
            <div class="d-flex">
                <a href="/perumahan" class="btn-get-started scrollto">Lihat Perumahan</a>
            </div>
        </div>
    </section>
</div>
