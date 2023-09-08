<?php

namespace App\Http\Livewire;

use App\Models\ProfilInstansi;
use App\Models\User;
use Livewire\Component;

class Registrasi extends Component
{
    public $nama;
    public $nomor_telepon;
    public $password;
    public $kode_otp;

    public $proses_1 = true;
    public $proses_2 = false;

    protected $listeners = [
        'error',
        'success'
    ];

    public function register()
    {
        $this->validate([
            'nama' => 'required|max:255',
            'nomor_telepon' => 'required|numeric|unique:users,no_hp',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama' => strtoupper($this->nama),
            'no_hp' => $this->nomor_telepon,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'status_verifikasi' => 0,
            'level' => 2,
        ]);

        $user = User::where('no_hp', $this->nomor_telepon)->first();

        User::where('no_hp', $this->nomor_telepon)->update([
            'otp' => $user->id . '' . mt_rand(0000, 9999)
        ]);

        $user_2 = User::where('no_hp', $this->nomor_telepon)->first();

        $this->sendsms($this->nomor_telepon, $user_2->otp);

        $this->proses_2();
        // $this->nama = '';
        // $this->nomor_telepon = '';
        // $this->password = '';

        $this->emit('success');

        session()->flash('message', 'success/Sukses !/Data berhasil disimpan');
    }

    public function verification()
    {
        $this->validate([
            'kode_otp' => 'required'
        ]);

        $user = User::where('otp', $this->kode_otp)
            ->where('status_verifikasi', '=', 0)
            ->first();

        if (!isset($user)) {
            session()->flash('error_kode');
        } else {
            User::where('id', $user->id)->update([
                'status_verifikasi' => 1
            ]);

            $this->emit('success');

            session()->flash('message_2', 'success/Sukses !/Verifikasi berhasil');
        }
    }

    public function proses_1()
    {
        $this->proses_1 = true;
        $this->proses_2 = false;
    }

    public function proses_2()
    {
        $this->proses_2 = true;
        $this->proses_1 = false;
    }

    public function sendsms($to, $otp)
    {
        //init SMS gateway, look at android SMS gateway
        $idmesin = "170";
        $pin = "123456";
        $msg = "Terima kasih telah melakukan registrasi akun di website PT. MATRIECS CIPTA ANUGERAH. Kode OTP anda adalah " . $otp;

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

    public function success()
    {
    }

    public function render()
    {
        return view('livewire.registrasi', [
            'title' => 'Registrasi',
            'subtitle' => '<li>Adminintrator</li>',
            'profil' => ProfilInstansi::first(),
        ])->layout('index');
    }
}
