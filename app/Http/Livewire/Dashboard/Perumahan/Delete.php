<?php

namespace App\Http\Livewire\Dashboard\Perumahan;

use App\Models\DetailPesanan;
use App\Models\Perumahan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Delete extends Component
{
    public $closeModal = false;

    // data request
    public $idDelete;

    public function mount($perumahan)
    {
        $this->idDelete = $perumahan;
    }

    public function destroy()
    {
        $perumahan = Perumahan::where('id_perumahan', $this->idDelete)->first();

        $cek_detail_pesanan = DetailPesanan::where('id_perumahan', $perumahan->id_perumahan)->get();

        if($cek_detail_pesanan->count() > 0){

            foreach ($cek_detail_pesanan as $data) {
                $cek_pesanan = Pesanan::where('id_pesanan', $data->id_pesanan)->first();
                if ($cek_pesanan) {
                    DB::table('pesanan')->where('id_pesanan', $cek_pesanan->id_pesanan)->delete();
                }
            }

            DB::table('detail_pesanan')->where('id_perumahan', $perumahan->id_perumahan)->delete();
        }

        if ($perumahan->image_1) {
            Storage::delete($perumahan->image_1);
        }
        if ($perumahan->image_2) {
            Storage::delete($perumahan->image_2);
        }
        if ($perumahan->image_3) {
            Storage::delete($perumahan->image_3);
        }

        Perumahan::destroy('id_perumahan', $this->idDelete);

        $this->emit('deleted');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.perumahan.delete');
    }
}
