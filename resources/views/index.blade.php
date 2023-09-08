@extends('layouts.app')

@section('container')
    <?php if(Request::is('/')) : ?>
    @livewire('beranda')

    <?php elseif(Request::is('perumahan')) : ?>
    @livewire('perumahan')

    <?php elseif(Request::is('perumahan/pesanan')) : ?>
    @livewire('pesanan')

    <?php elseif(Request::is('perumahan/pesanan/history')) : ?>
    @livewire('history-pesanan')

    <?php elseif(Request::is('login')) : ?>
    @livewire('login')

    <?php elseif(Request::is('registrasi')) : ?>
    @livewire('registrasi')

    <?php endif ?>
@endsection
