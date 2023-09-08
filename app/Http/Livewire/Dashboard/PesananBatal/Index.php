<?php

namespace App\Http\Livewire\Dashboard\PesananBatal;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $showLivewireCreate = false;
    public $showLivewireUpdate = false;
    public $showLivewireDelete = false;
    public $showLivewireShow = false;
    public $pesanan_masuk = 0;

    public $paginate = 15;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'stored' => 'handleStored',
        'updated' => 'handleUpdated',
        'deleted' => 'handleDeleted',

        'cancelCreate' => 'handleCancelCreate',
        'cancelUpdate' => 'handleCancelUpdate',
        'cancelShow' => 'handleCancelShow',

        'success',
        'error'
    ];

    // delete
    public function delete($id)
    {
        $pesanan = Pesanan::where('id_pesanan', $id)->first();
        
        foreach ($pesanan->pesanan_detail as $data) {
            DB::table('detail_pesanan')->where('id_detail', $data->id_detail)->delete();
        }

        Pesanan::destroy('id_pesanan', $id);

        $this->emit('success');
        session()->flash('message', 'success/Pesanan berhasil dihapus');
    }

    public function success()
    {
    }

    public function render()
    {
        $this->pesanan_masuk =  Pesanan::where('status', 2)->count();

        return view('livewire.dashboard.pesanan-batal.index', [
            'title' => 'PT. MATRIECS CIPTA ANUGERAH | Dashboard - Pesanan Masuk',
            'icon' => '<i class="bi bi-envelope-check-fill"></i>',
            'title_page' => 'Pesanan Masuk',
            'pesanan' => $this->search == null ?
                Pesanan::orderBy('id_pesanan', 'DESC')->where('status', 2)->paginate($this->paginate) :
                Pesanan::where('created_at', 'like', '%' . $this->search . '%')->where('status', 1)->orderBy('id_pesanan')
                ->paginate($this->paginate),
        ])->extends('dashboard-layouts.app')->section('container');
    }

}
