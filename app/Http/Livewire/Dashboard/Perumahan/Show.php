<?php

namespace App\Http\Livewire\Dashboard\Perumahan;

use App\Models\Perumahan;
use Livewire\Component;

class Show extends Component
{
    public $showModal = false;
    public $closeModal = false;

    // data request
    public $nama_perumahan;
    public $slug;
    public $harga;
    public $uang_muka;
    public $angsuran;
    public $type;
    public $jumlah;
    public $stok;
    public $fasilitas;
    public $informasi_lain;
    public $image_1;
    public $image_2;
    public $image_3;

    public function mount($perumahan)
    {
        $this->nama_perumahan = $perumahan['nama_perumahan'];
        $this->slug = $perumahan['slug'];
        $this->harga = $perumahan['harga'];
        $this->uang_muka = $perumahan['uang_muka'];
        $this->angsuran = $perumahan['angsuran'];
        $this->type = $perumahan['type'];
        $this->stok = $perumahan['stok'];
        $this->jumlah = $perumahan['jumlah'];
        $this->fasilitas = $perumahan['fasilitas'];
        $this->informasi_lain = $perumahan['informasi_lain'];
        $this->image_1 = $perumahan['image_1'];
        $this->image_2 = $perumahan['image_2'];
        $this->image_3 = $perumahan['image_3'];
    }

    public function render()
    {
        return view('livewire.dashboard.perumahan.show');
    }
}
