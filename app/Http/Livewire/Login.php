<?php

namespace App\Http\Livewire;

use App\Models\ProfilInstansi;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Login extends Component
{
    public $nomor_telepon;
    public $password;
    public $remember_me = false;

    protected $listeners = [
        'error'
    ];

    public function auth(Request $request)
    {

        $remember_me = $this->remember_me ? true : false;

        $validateData =  $this->validate([
            'nomor_telepon' => 'required',
            'password' => 'required'
        ]);

        $auth['no_hp'] = $validateData['nomor_telepon'];
        $auth['password'] = $validateData['password'];

        if (Auth::attempt($auth, $remember_me)) {
            session()->regenerate();
            if (auth()->user()->level == 1) {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/');
            }
            // return redirect()->intended('/dashboard')->with('message', 'success/Login Berhasil');
        }

        $this->emit('error');

        return back()->with('message', 'error/Maaf login gagal');
    }

    public function error()
    {
    }

    public function render()
    {
        return view('livewire.login', [
            'title' => 'Login',
            'subtitle' => '<li>Adminintrator</li>',
            'profil' => ProfilInstansi::first(),
        ])->layout('index');
    }
}
