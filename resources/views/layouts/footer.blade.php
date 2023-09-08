@php
    $profil = \App\Models\ProfilInstansi::first();
@endphp

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

<footer id="footer" data-aos="fade-up" data-aos-duration="1000" style="background-color: rgb(87, 2, 61);">
    <div class="footer-top" style="background-color: rgb(87, 2, 61);">
        <div class="container text-light">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-info">
                        <h6 class="fw-bold">{{ strtoupper($profil->nama_instansi) }}</h6>
                        <p>
                            {{ ucwords($profil->alamat) }}<br>
                            Kode POS <b>{{ $profil->kode_pos }}</b><br><br>

                            <i class="bi bi-envelope"></i>
                            <span style="margin-left: 5px;">
                                <a class="text-decoration" href="mailto:{{ $profil->email }}">{{ $profil->email }}
                                </a>
                            </span>
                            <br>
                            <i class="bi bi-phone"></i>
                            <span style="margin-left: 5px;">+{{ $profil->telepon }}
                            </span>
                            <br>
                            {{-- <i class="bi bi-facebook"></i>
                            <span style="margin-left: 5px;">{{ $profil->facebook }}
                            </span>
                            <br> --}}
                        </p>
                        {{-- <span class="text-secondary"><i class="bi bi-eye-fill"></i> {{ $kunjungan[0] }} kali
                            dikunjungi</span> --}}
                    </div>
                </div>


                <div class="col-md-9 footer-links">
                    <h4 class="text-light">Lokasi {{ $profil->nama_instansi }}</h4>
                    <div wire:ignore style="">
                        <div id="address-map-container" class="" style="width:100%;">
                            <div wire:ignore.self id="map2" style="height: 300px;border-radius: 3px;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container py-4 d-flex justify-content-center text-light">
        <div class="copyright">
            &copy; Copyright <strong><span>{{ ucwords($profil->nama_instansi) }}</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            {{-- Designed by <a href="/">Sasri Al Fatih</a> --}}
        </div>
    </div>

</footer>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>


@livewireScripts

<script src="/vendor/aos/aos.js"></script>
<script>
    AOS.init();
</script>
<!-- bootstrap -->
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Templates -->
<script src="/vendor/templates/glightbox/js/glightbox.min.js"></script>
<script src="/vendor/templates/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/vendor/templates/swiper/swiper-bundle.min.js"></script>
<script src="/vendor/templates/waypoints/noframework.waypoints.js"></script>

<script src="/vendor/templates/main/main.js"></script>

{{-- calendar --}}
<script src="/vendor/calendar/datepicker.min.js"></script>

<script type="text/javascript" src="/vendor/purecounter/purecounter_vanilla.js"></script>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script>
    $(document).ready(function() {
        var latitude = {{ $profil->latitude }};
        var longitude = {{ $profil->longitude }};
        var map = L.map('map2').setView([latitude, longitude], 17.5);

        googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        var marker = L.marker([latitude, longitude]).addTo(map);

        var circle = L.circle([latitude, longitude], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 40
        }).addTo(map);

        map.scrollWheelZoom.disable();

        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Koordinat  posisi. " + e.latlng)
                .openOn(map);
        }

        map.on('click', onMapClick);
    });
</script>

</body>

</html>
