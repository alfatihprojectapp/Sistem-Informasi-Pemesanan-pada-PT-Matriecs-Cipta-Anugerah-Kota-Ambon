<?php

namespace App\Http\Livewire\Dashboard\Pelanggan;

use App\Http\Livewire\Pesanan;
use App\Models\Pelanggan;
use App\Models\Perumahan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $showLivewireCreate = false;
    public $showLivewireUpdate = false;
    public $showLivewireDelete = false;
    public $showLivewireShow = false;
    public $jumlah_pelanggan = 0;

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

    public function delete($id)
    {
        $pelanggan = Pelanggan::where('id_pelanggan', $id)->first();

        foreach ($pelanggan->pesanan->pesanan_detail as $data) {
            Perumahan::where('id_perumahan', $data->perumahan->id_perumahan)->update([
                'stok' => $data->perumahan->stok + 1
            ]);

            DB::table('detail_pesanan')->where('id_detail', $data->id_detail)->delete();
        }

        DB::table('pesanan')->where('id_pesanan', $pelanggan->id_pesanan)->delete();
        DB::table('pelanggan')->where('id_pelanggan', $pelanggan->id_pelanggan)->delete();

        // Pesanan::destroy('id_pesanan', $pelanggan->id_pesanan);
        // Pelanggan::destroy('id_pelanggan', $pelanggan->id_pelanggan);

        $this->emit('success');
        session()->flash('message', 'success/Pesanan berhasil dihapus');
    }

    public function success()
    {
    }

    public function render()
    {
        $this->jumlah_pelanggan =  Pelanggan::count();

        return view('livewire.dashboard.pelanggan.index', [
            'title' => 'PT. MATRIECS CIPTA ANUGERAH | Dashboard - Daftar Pelanggan',
            'icon' => '<i class="bi bi-people"></i>',
            'title_page' => 'Daftar Pelanggan',
            'pelanggan' => $this->search == null ?
                Pelanggan::orderBy('nama')->paginate($this->paginate) :
                Pelanggan::where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('nama')
                ->paginate($this->paginate),
        ])->extends('dashboard-layouts.app')->section('container');
    }

}
