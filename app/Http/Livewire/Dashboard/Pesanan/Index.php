<?php

namespace App\Http\Livewire\Dashboard\Pesanan;

use App\Models\Pelanggan;
use App\Models\Perumahan;
use App\Models\Pesanan;
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

    // pesanan batal
    public function pesanan_batal($id)
    {
        Pesanan::where('id_pesanan', $id)->update([
            'status' => 2
        ]);

        $this->emit('success');
        session()->flash('message', 'success/Pesanan berhasil dibatalkan');
    }

    // pesanan disetujui
    public function pesanan_disetujui($id)
    {
        $pesanan = Pesanan::where('id_pesanan', $id)->first();
        
        foreach ($pesanan->pesanan_detail as $data) {
            // dd($data->jumlah_pesanan);
            Perumahan::where('id_perumahan', $data->perumahan->id_perumahan)->update([
                'stok' => $data->perumahan->stok - $data->jumlah_pesanan
            ]);
        }

        Pesanan::where('id_pesanan', $id)->update([
            'status' => 3
        ]);

        Pelanggan::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'nama' => strtoupper($pesanan->user->nama),
            'telepon' => $pesanan->user->no_hp,
            'alamat' => $pesanan->user->alamat,
        ]);

        $this->emit('success');
        session()->flash('message', 'success/Pesanan berhasil disetujui dan data ini akan dimasukan kedalam data pelanggan');
    }

    public function success()
    {
    }

    public function render()
    {
        $this->pesanan_masuk =  Pesanan::where('status', 1)->count();

        return view('livewire.dashboard.pesanan.index', [
            'title' => 'PT. MATRIECS CIPTA ANUGERAH | Dashboard - Pesanan Masuk',
            'icon' => '<i class="bi bi-envelope-check-fill"></i>',
            'title_page' => 'Pesanan Masuk',
            'pesanan' => $this->search == null ?
                Pesanan::orderBy('id_pesanan', 'DESC')->where('status', 1)->paginate($this->paginate) :
                Pesanan::where('created_at', 'like', '%' . $this->search . '%')->where('status', 1)->orderBy('id_pesanan')
                ->paginate($this->paginate),
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
