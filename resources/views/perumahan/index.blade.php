@extends('layouts.app')

@section('container')
    <title>{{ ucwords($profil->nama_instansi) }} - {{ $title }}</title>

    <section id="team" class="team section-bg">
        <div wire:ignore.self class="container" data-aos="fade-up">

            <div class="section-title">
                <div class="d-flex align-items-center justify-content-center" style="margin-top: -40px;">
                    <div class="d-inline-block"
                        style="width: 15px;height: 15px; border-top: 3px solid rgb(87, 2, 61) ;border-left: 4px solid;">
                    </div>
                    <h4 style="margin-top: 30px;margin-left: px;">
                        <i class="bi bi-house "></i> DAFTAR PERUMAHAN
                    </h4>
                    <div class="d-inline-block"
                        style="width: 15px;height: 15px; border-bottom: 3px solid rgb(87, 2, 61) ;border-right: 4px solid;margin-top: 45px;margin-left: px;">
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($perumahan as $data)
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch justify-content-center" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="member" style="width: 100%;">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $data->image_1) }}" class="img-fluid w-100">
                            </div>
                            <div class="member-info">
                                <ol class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                        <div class="me-auto">
                                            <div class="fw-bold" style="font-size: 11pt;">
                                                {{ $data->nama_perumahan }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                        <div class="me-auto">
                                            <div class="fw-normal" style="font-size: 11pt;">Harga Unit</div>
                                        </div>
                                        <span class="">{{ 'Rp. '.number_format($data->harga,2) }}<i class="bi bi-tag ms-1"></i></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                        <div class="me-auto">
                                            <div class="fw-normal" style="font-size: 11pt;">Uang Muka</div>
                                        </div>
                                        <span class="">{{ 'Rp. '.number_format($data->uang_muka,2) }}<i class="bi bi-tag ms-1"></i></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                        <div class="me-auto">
                                            <div class="fw-normal" style="font-size: 11pt;">Angsuran</div>
                                        </div>
                                        <span class="">{{ 'Rp. '.number_format($data->angsuran,2).'/Bln.' }}<i class="bi bi-tag ms-1"></i></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border-color: rgb(87, 2, 61);">
                                        <div class="me-auto">
                                            <div class="fw-normal" style="font-size: 11pt;">Type</div>
                                        </div>
                                        <span class="">{{ $data->type }}<i class="bi bi-tag ms-1"></i></span>
                                    </li>
                                </ol>
                                <div class="d-flex align-items-center mt-3">
                                    <style>
                                        .detail{
                                            background: #de00e6;
                                        }
                                        .detail:hover{
                                            background: #4d0040;
                                            transition: 0.3s;
                                        }
                                    </style>
                                    <a href="/perumahan/{{ $data->slug }}/show" class="detail badge py-2 px-3 w-100 text-light">Lihat
                                        Detail Perumahan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
