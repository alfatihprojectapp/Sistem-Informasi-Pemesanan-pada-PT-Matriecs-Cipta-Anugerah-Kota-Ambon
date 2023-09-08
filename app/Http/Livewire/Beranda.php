<?php

namespace App\Http\Livewire;

use App\Models\ProfilInstansi;
use Livewire\Component;

class Beranda extends Component
{
    public function render()
    {
        return view('livewire.beranda', [
            'title' => 'Beranda',
            'subtitle' => '',
            // 'profil' => ProfilInstansi::first(),
        ])->layout('index');
    }
}
