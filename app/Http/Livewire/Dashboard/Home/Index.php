<?php

namespace App\Http\Livewire\Dashboard\Home;

use App\Models\Pelanggan;
use App\Models\Pesanan;
use Livewire\Component;

class Index extends Component
{
    public $pesan_masuk;
    public $pesan_batal;
    public $jum_pelanggan;

    public function render()
    {
        $this->pesan_masuk = Pesanan::where('status', 1)->count();
        $this->pesan_batal = Pesanan::where('status', 2)->count();
        $this->jum_pelanggan = Pelanggan::count();
        
        return view('livewire.dashboard.home.index', [
            'title' => 'PT. MATRIECS CIPTA ANUGERAH | Dashboard',
            'icon' => '<i class="bi bi-layout-text-sidebar-reverse"></i>',
            'title_page' => 'Dashboard',

        ])->extends('dashboard-layouts.app')->section('container');
    }
}
