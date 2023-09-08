<?php

namespace App\Http\Livewire;

use App\Models\Pesanan;
use App\Models\User;
use Livewire\Component;

class CheckOut extends Component
{
    public $closeModal = false;

    // data request
    public $nomor_telepon;
    public $alamat;


    public function mount($telepon, $alamat)
    {
        $this->nomor_telepon = $telepon;
        $this->alamat = $alamat;
    }

    public function store()
    {
        $this->validate([
            'nomor_telepon' => 'required|numeric',
            'alamat' => 'required'
        ]);

        if ($this->nomor_telepon != auth()->user()->no_hp) {
            session()->flash('error');
            return false;
        }

        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();

        Pesanan::where('id_pesanan', $pesanan->id_pesanan)->update([
            'status' => 1
        ]);

        User::where('id', auth()->user()->id)->update([
            'no_hp' => $this->nomor_telepon,
            'alamat' => $this->alamat
        ]);

        $this->sendsms(auth()->user()->no_hp);

        $this->emit('checkOutSuccess');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function sendsms($to)
    {
        //init SMS gateway, look at android SMS gateway
        $idmesin = "170";
        $pin = "123456";
        $msg = "Terima kasih telah melakukan pemesanan rumah di website PT. MATRIECS CIPTA ANUGERAH. Pesanan akan segera dikonfirmasi dan anda akan segera dihubungi";

        $msg = str_replace(" ", "%20", $msg);

        // create curl resource
        $ch = curl_init();
        // $to = 

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://sms.indositus.com/sendsms.php?idmesin=$idmesin&pin=$pin&to=$to&text=$msg");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        return ($output);
    }

    public function render()
    {
        return view('livewire.check-out');
    }
}
