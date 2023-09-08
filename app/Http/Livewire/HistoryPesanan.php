<?php

namespace App\Http\Livewire;

use App\Models\Pesanan;
use App\Models\ProfilInstansi;
use Livewire\Component;

class HistoryPesanan extends Component
{
    public function render()
    {
        return view('livewire.history-pesanan',[
            'title' => 'History Pesanan',
            // 'subtitle' => '<li>Adminintrator</li>',
            'profil' => ProfilInstansi::first(),
            'pesanan' => Pesanan::where('user_id', auth()->user()->id)->where('status', '!=', 0)->orderBy('id_pesanan', 'DESC')->get()
        ])->layout('index');
    }
}
