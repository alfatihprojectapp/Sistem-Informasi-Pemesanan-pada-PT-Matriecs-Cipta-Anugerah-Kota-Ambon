<?php

namespace App\Http\Livewire\Dashboard\ProfilInstansi;

use App\Models\ProfilInstansi;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $closeModal = false;

    // data request
    public $nama_instansi;
    public $deskripsi;
    public $latitude;
    public $longitude;
    public $kode_pos;
    public $alamat;
    public $email;
    public $telepon;
    public $logo;
    public $logo_old;

    public $idEdit;

    public function mount($profil)
    {
        $this->nama_instansi = $profil['nama_instansi'];
        $this->deskripsi = $profil['deskripsi'];
        $this->latitude = $profil['latitude'];
        $this->longitude = $profil['longitude'];
        $this->kode_pos = $profil['kode_pos'];
        $this->alamat = $profil['alamat'];
        $this->email = $profil['email'];
        $this->telepon = $profil['telepon'];
        $this->logo_old = $profil['logo'];

        $this->idEdit = $profil['id'];
    }

    public function update()
    {
        
        $rules  = [
            'nama_instansi' => 'required|max:255',
            'deskripsi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'kode_pos' => 'required',
            'alamat' => 'required',
            'email' => 'required|max:255|email',
            'telepon' => 'required|numeric',
            // 'logo' => 'required',
        ];

        if ($this->logo) {
            $rules['logo'] = 'required|image|max:2024';
        }

        $this->validate($rules);

        $profil = ProfilInstansi::first();

        if ($this->logo) {
            if ($this->logo_old) {
                Storage::delete($this->logo_old);
            }
            $fileName = $this->logo->store('profil-instansi');
        } else {
            $fileName = $profil->logo;
        }

        ProfilInstansi::where('id', $profil->id)->update([
            'nama_instansi' => $this->nama_instansi,
            'deskripsi' => $this->deskripsi,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'kode_pos' => $this->kode_pos,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'telepon' => $this->telepon,
            'logo' => $fileName,
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
        return view('livewire.dashboard.profil-instansi.update');
    }
}
