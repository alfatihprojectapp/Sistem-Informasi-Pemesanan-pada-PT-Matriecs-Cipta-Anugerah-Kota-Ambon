<?php

namespace App\Http\Livewire\Dashboard\Perumahan;

use App\Models\Perumahan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class Create extends Component
{
    use WithFileUploads;

    public $closeModal = false;

    // data request
    public $nama_perumahan;
    public $harga;
    public $uang_muka;
    public $angsuran;
    public $type;
    public $jumlah;
    public $fasilitas;
    public $informasi_lain;
    public $image_1;
    public $image_2;
    public $image_3;

    public function store()
    {
        $this->validate([
            'nama_perumahan' => 'required|max:255',
            'harga' => 'required|numeric',
            'uang_muka' => 'required|numeric',
            'angsuran' => 'required|numeric',
            'jumlah' => 'required|numeric',
            // 'stok' => 'required|numeric',
            'type' => 'required|max:255',
            'fasilitas' => 'required',
            // 'informasi_lain' => 'required',
            'image_1' => 'required|image|max:2024',
            'image_2' => 'required|image|max:2024',
            'image_3' => 'required|image|max:2024',
        ]);

        $image_1 = $this->image_1->store('perumahan');
        $image_2 = $this->image_2->store('perumahan');
        $image_3 = $this->image_3->store('perumahan');

        $slug = SlugService::createSlug(Perumahan::class, 'slug', $this->nama_perumahan);

        Perumahan::create([
            'nama_perumahan' => strtoupper($this->nama_perumahan),
            'slug' => $slug,
            'harga' => $this->harga,
            'uang_muka' => $this->uang_muka,
            'angsuran' => $this->angsuran,
            'type' => $this->type,
            'jumlah' => $this->jumlah,
            'stok' => $this->jumlah,
            'fasilitas' => $this->fasilitas,
            'informasi_lain' => $this->informasi_lain,
            'image_1' => $image_1,
            'image_2' => $image_2,
            'image_3' => $image_3,
        ]);

        $this->emit('stored');

        $this->cleanLiveWireTemp();

        $this->closeModal = true;

        session()->flash('message');
    }

    protected function cleanLiveWireTemp()
    {
        $storage = Storage::disk('public');

        foreach ($storage->allFiles('livewire-tmp') as $filePath) {
            $storage->delete($filePath);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.perumahan.create');
    }
}
