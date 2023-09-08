<?php

namespace App\Http\Livewire\Dashboard\Perumahan;

use App\Models\Perumahan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class Update extends Component
{
    use WithFileUploads;

    public $closeModal = false;

    // data request
    public $nama_perumahan;
    // public $slug;
    public $harga;
    public $uang_muka;
    public $angsuran;
    public $type;
    public $jumlah;
    // public $stok;
    public $fasilitas;
    public $informasi_lain;
    public $image_1;
    public $image_2;
    public $image_3;

    public $image_1_old;
    public $image_2_old;
    public $image_3_old;

    public $idEdit;


    public function mount($perumahan)
    {
        $this->nama_perumahan = $perumahan['nama_perumahan'];
        $this->harga = $perumahan['harga'];
        $this->uang_muka = $perumahan['uang_muka'];
        $this->angsuran = $perumahan['angsuran'];
        $this->type = $perumahan['type'];
        $this->jumlah = $perumahan['jumlah'];
        $this->fasilitas = $perumahan['fasilitas'];
        $this->informasi_lain = $perumahan['informasi_lain'];
        $this->image_1_old = $perumahan['image_1'];
        $this->image_2_old = $perumahan['image_2'];
        $this->image_3_old = $perumahan['image_3'];

        $this->idEdit = $perumahan['id_perumahan'];
    }

    public function update($id)
    {
        
        $rules  = [
            'nama_perumahan' => 'required|max:255',
            'harga' => 'required|numeric',
            'uang_muka' => 'required|numeric',
            'angsuran' => 'required|numeric',
            'jumlah' => 'required|numeric',
            // 'stok' => 'required|numeric',
            'type' => 'required|max:255',
            'fasilitas' => 'required',
            // 'informasi_lain' => 'required',
            // 'image_1' => 'required|image|max:2024',
            // 'image_2' => 'required|image|max:2024',
            // 'image_3' => 'required|image|max:2024',
        ];

        if ($this->image_1) {
            $rules['image_1'] = 'required|image|max:2024';
        }
        if ($this->image_2) {
            $rules['image_2'] = 'required|image|max:2024';
        }
        if ($this->image_3) {
            $rules['image_3'] = 'required|image|max:2024';
        }

        $this->validate($rules);

        $perumahan = Perumahan::where('id_perumahan', $id)->first();

        if ($this->image_1) {
            if ($this->image_1_old) {
                Storage::delete($this->image_1_old);
            }
            $fileName1 = $this->image_1->store('perumahan');
        } else {
            $fileName1 = $perumahan->image_1;
        }

        if ($this->image_2) {
            if ($this->image_2_old) {
                Storage::delete($this->image_2_old);
            }
            $fileName2 = $this->image_2->store('perumahan');
        } else {
            $fileName2 = $perumahan->image_2;
        }

        if ($this->image_3) {
            if ($this->image_3_old) {
                Storage::delete($this->image_3_old);
            }
            $fileName3 = $this->image_3->store('perumahan');
        } else {
            $fileName3 = $perumahan->image_3;
        }

        $slug = SlugService::createSlug(Perumahan::class, 'slug', $this->nama_perumahan);

        Perumahan::where('id_perumahan', $id)->update([
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
            'image_1' => $fileName1,
            'image_2' => $fileName2,
            'image_3' => $fileName3,
        ]);

        $this->emit('updated');

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
        return view('livewire.dashboard.perumahan.update');
    }
}
