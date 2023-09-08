<?php

namespace App\Http\Livewire;

use App\Models\DetailPesanan;
use App\Models\Pesanan as ModelsPesanan;
use App\Models\ProfilInstansi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Pesanan extends Component
{
    public $showModalCheckOut = false;
    public $telepon;
    public $alamat;

    protected $listeners = [
        'success',
        'error',
        'checkOutSuccess' => 'handleCheckOut',

        'closeLivewire' => 'handleCloseLivewire',
    ];

    // delete pesan keranjang
    public function delete($id)
    {
        $detail = DetailPesanan::where('id_detail', $id)->first();

        $pesanan = ModelsPesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();

        ModelsPesanan::where('id_pesanan', $pesanan->id_pesanan)->update([
            'total_harga' => $pesanan->total_harga -  $detail->total_harga
        ]);

        DetailPesanan::destroy($detail->id_detail);

        $this->emit('success');
    }

    public function check_out()
    {
        $this->showModalCheckOut = true;

        $this->telepon = auth()->user()->no_hp;
        $this->alamat = auth()->user()->alamat;
    }

    public function handleCloseLivewire()
    {
        $this->showModalCheckOut = false;
    }

    public function handleCheckOut()
    {
        $this->showModalCheckOut = false;
    }

    public function success()
    {
    }

    public function error()
    {
    }

    public function render()
    {
        $pesanan = ModelsPesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        if (empty($pesanan)) {
            return view('livewire.pesanan', [
                'title' => 'Keranjang Pesanan',
                'profil' => ProfilInstansi::first(),
                'daftar_pesanan' => null,
                'total_pembayaran' => 0,
                'pesanan' => null
            ])->layout('index');
        } else {

            $list_pesanan = DetailPesanan::where('id_pesanan', $pesanan->id_pesanan)
                ->orderBy('id_detail', 'DESC')->get();

            return view('livewire.pesanan', [
                'title' => 'Keranjang Pesanan',
                // 'subtitle' => '<li>Adminintrator</li>',
                'profil' => ProfilInstansi::first(),
                'daftar_pesanan' => $list_pesanan,
                'total_pembayaran' => $pesanan->total_harga,
                'pesanan' => $pesanan
            ])->layout('index');
        }
    }
}
