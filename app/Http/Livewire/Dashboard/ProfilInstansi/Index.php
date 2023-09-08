<?php

namespace App\Http\Livewire\Dashboard\ProfilInstansi;

use App\Models\ProfilInstansi;
use Livewire\Component;

class Index extends Component
{
    public $showLivewireUpdate = false;
    public $getProfil;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'updated' => 'handleUpdated',

        'closeLivewire' => 'handleCloseLivewire',
    ];

    // edit
    public function edit()
    {
        $this->showLivewireUpdate = true;

        $profil = ProfilInstansi::first();
        $this->getProfil = $profil;
    }
    public function handleUpdated()
    {
        $this->showLivewireUpdate = false;
    }

    public function handleCloseLivewire()
    {
        $this->showLivewireUpdate = false;
    }

    public function render()
    {
        return view('livewire.dashboard.profil-instansi.index',[
            'title' => 'PT. MATRIECS CIPTA ANUGERAH | Dashboard - Profil Instansi',
            'icon' => '<i class="bi bi-info-square"></i>',
            'title_page' => 'Profil Instansi',
            'profil' => ProfilInstansi::first()
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
