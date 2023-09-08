<?php

use App\Http\Controllers\LihatPesananController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerumahanController;
use App\Http\Livewire\Beranda;
use App\Http\Livewire\Dashboard\Home\Index;
use App\Http\Livewire\Dashboard\Pelanggan\Index as PelangganIndex;
use App\Http\Livewire\Dashboard\Perumahan\Index as PerumahanIndex;
use App\Http\Livewire\Dashboard\Pesanan\Index as PesananIndex;
use App\Http\Livewire\Dashboard\PesananBatal\Index as PesananBatalIndex;
use App\Http\Livewire\Dashboard\ProfilInstansi\Index as ProfilInstansiIndex;
use App\Http\Livewire\Dashboard\User\Index as UserIndex;
use App\Http\Livewire\Login;
use App\Http\Livewire\Pesanan;
use App\Http\Livewire\Registrasi;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Beranda::class);
Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/registrasi', Registrasi::class)->middleware('guest');
Route::controller(LogoutController::class)->group(function () {
    Route::post('/logout', 'logout')->middleware('auth');
});

Route::controller(PerumahanController::class)->group(function () {
    Route::get('/perumahan', 'index');
    Route::get('/perumahan/{perumahan:slug}/show', 'show');
    Route::post('/perumahan/{perumahan:slug}/cart', 'cart')->middleware('auth');
});

Route::get('/perumahan/pesanan', Pesanan::class)->middleware('auth');
Route::get('/perumahan/pesanan/history', Pesanan::class)->middleware('auth');
Route::controller(LihatPesananController::class)->group(function () {
    Route::get('/get-pesanan-detail', 'get_pesanan_detail')->middleware('auth');
});

// admin
Route::get('/dashboard', Index::class)->middleware('admin');
Route::get('/dashboard/perumahan', PerumahanIndex::class)->middleware('admin');
Route::get('/dashboard/pesanan-masuk', PesananIndex::class)->middleware('admin');
Route::get('/dashboard/pesanan-batal', PesananBatalIndex::class)->middleware('admin');
Route::get('/dashboard/daftar-pelanggan', PelangganIndex::class)->middleware('admin');
Route::get('/dashboard/profil-instansi', ProfilInstansiIndex::class)->middleware('admin');
Route::get('/dashboard/users', UserIndex::class)->middleware('admin');
