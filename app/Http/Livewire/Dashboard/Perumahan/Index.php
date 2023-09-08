<?php

namespace App\Http\Livewire\Dashboard\Perumahan;

use App\Models\Perumahan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showLivewireCreate = false;
    public $showLivewireUpdate = false;
    public $showLivewireDelete = false;
    public $showLivewireShow = false;

    public $getPerumahan;

    public $paginate = 15;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'stored' => 'handleStored',
        'updated' => 'handleUpdated',
        'deleted' => 'handleDeleted',

        'closeLivewire' => 'handleCloseLivewire'
    ];

    // create
    public function create()
    {
        $this->showLivewireCreate = true;
    }
    public function handleStored()
    {
        $this->showLivewireCreate = false;
    }

    // show
    public function show($id)
    {
        $this->showLivewireShow = true;

        $perumahan = Perumahan::where('id_perumahan', $id)->first();
        $this->getPerumahan = $perumahan;
    }

    // edit
    public function edit($id)
    {
        $this->showLivewireUpdate = true;

        $perumahan = Perumahan::where('id_perumahan', $id)->first();
        $this->getPerumahan = $perumahan;
    }
    public function handleUpdated()
    {
        $this->showLivewireUpdate = false;
    }

    // delete
    public function delete($id)
    {
        $this->showLivewireDelete = true;

        $perumahan = Perumahan::where('id_perumahan', $id)->first();
        $this->getPerumahan = $perumahan->id_perumahan;
    }
    public function handleDeleted()
    {
        $this->showLivewireDelete = false;
    }

    public function handleCloseLivewire()
    {
        $this->showLivewireCreate = false;
        $this->showLivewireUpdate = false;
        $this->showLivewireShow = false;
        $this->showLivewireDelete = false;
    }

    public function render()
    {
        return view('livewire.dashboard.perumahan.index', [
            'title' => 'PT. MATRIECS CIPTA ANUGERAH | Dashboard - Perumahan',
            'icon' => '<i class="bi bi-house"></i>',
            'title_page' => 'Perumahan',
            'perumahan' => $this->search == null ?
                Perumahan::orderBy('id_perumahan', 'DESC')->paginate($this->paginate) :
                Perumahan::where('nama_perumahan', 'like', '%' . $this->search . '%')->orderBy('nama_perumahan')
                ->paginate($this->paginate)
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
