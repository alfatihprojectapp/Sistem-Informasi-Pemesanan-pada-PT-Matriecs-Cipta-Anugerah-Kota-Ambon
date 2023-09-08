@extends('layouts.app')

@section('container')
    @if (session()->has('message'))
        <?php
        $message = explode('/', session('message'));
        echo "
                                                        <script>
                                                                Swal.fire({
                                                                icon: '$message[0]',
                                                                text: '$message[1]',
                                                                allowOutsideClick: false
                                                            })
                                                        </script>
                                                        ";
        ?>
    @endif

    <title>{{ ucwords($profil->nama_instansi) }} - {{ $title }}</title>

    <main wire:ignore.self id="main" data-aos="fade-up">

        <section class="breadcrumbs"  style="background-color: rgb(255, 140, 221);">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-light"> {{ 'PERUMAHAN ' . $perumahan->nama_perumahan }}
                </div>
                </h2>
            </div>

            </div>
        </section>

        <section id="portfolio-details" class="portfolio-details">
            <div class="container">

                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="portfolio-details-slider swiper">
                            <div class="swiper-wrapper align-items-center">

                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $perumahan->image_1) }}" alt="">
                                </div>

                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $perumahan->image_2) }}" alt="">
                                </div>

                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $perumahan->image_3) }}" alt="">
                                </div>

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="portfolio-info">
                            <h3>Informasi Perumahan</h3>
                            <ol class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                    <div class="me-auto">
                                        <div class="fw-normal">Harga/Unit</div>
                                    </div>
                                    <span class="text-secondary">{{ 'Rp. ' . number_format($perumahan->harga, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                    <div class="me-auto">
                                        <div class="fw-normal">Uang Muka</div>
                                    </div>
                                    <span
                                        class="text-secondary">{{ 'Rp. ' . number_format($perumahan->uang_muka, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                    <div class="me-auto">
                                        <div class="fw-normal">Angsuran</div>
                                    </div>
                                    <span
                                        class="text-secondary">{{ 'Rp. ' . number_format($perumahan->angsuran, 2) . '/Bln.' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                    <div class="me-auto">
                                        <div class="fw-normal">Type</div>
                                    </div>
                                    <span class="text-secondary">{{ $perumahan->type }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                    <div class="me-auto">
                                        <div class="fw-normal">Jumlah Rumah</div>
                                    </div>
                                    <span class="text-secondary">{{ $perumahan->jumlah }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                    <div class="me-auto">
                                        <div class="fw-normal">Tersedia</div>
                                    </div>
                                    @if ($perumahan->stok != 0)
                                        <span class="text-secondary">{{ $perumahan->stok }}</span>
                                    @else
                                        <span class="fw-bold" style="font-size: 18pt;">{{ $perumahan->stok }}</span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                    <div class="me-auto">
                                        <div class="fw-normal">Fasilitas</div>
                                    </div>
                                    <span class="text-secondary">{!! $perumahan->fasilitas !!}</span>
                                </li>
                            </ol>
                            @if ($perumahan->stok != 0)
                                <form action="/perumahan/{{ $perumahan->slug }}/cart" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="id_perumahan" value="{{ $perumahan->id_perumahan }}">

                                    <label for="jumlah_pesanan" class="fw-bold">Pesan Rumah Sekarang</label>
                                    @if (session()->has('error_pesanan'))
                                        <div class="">
                                            <small class="text-danger">pesanan tidak boleh lebih dari 1.</small>
                                        </div>
                                    @endif
                                    @if (session()->has('pesanan_double'))
                                        <div>
                                            <small class="text-danger">
                                                pesanan anda akan ditolak dikarenakan anda sudah terdaftar seabagi
                                                pelanggan.
                                            </small>
                                        </div>
                                    @endif
                                    @if (session()->has('user_exist'))
                                        <div>
                                            <small class="text-danger">
                                                anda sudah melakukan pesanan.
                                            </small>
                                        </div>
                                    @endif
                                    <div class="input-group mb-3">
                                        <input type="text"
                                            class="form-control @error('jumlah_pesanan') is-invalid @enderror
                                    @if (session()->has('error_cart')) is-invalid @endif"
                                            placeholder="Jumlah pesanan" id="jumlah_pesanan" name="jumlah_pesanan">
                                        <button class="btn btn-light" type="submit"
                                            id="button-addon2" style="border-color: rgb(87, 2, 61);"><i class="bi bi-cart"></i>
                                        </button>
                                        @error('jumlah_pesanan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h2>Informasi Lainnya</h2>
                        {!! $perumahan->informasi_lain !!}
                    </div>
                </div>

            </div>
        </section>

    </main>
@endsection
