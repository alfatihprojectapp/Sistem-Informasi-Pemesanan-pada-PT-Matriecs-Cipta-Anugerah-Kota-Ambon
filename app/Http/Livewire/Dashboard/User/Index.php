<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showLivewireCreate = false;
    public $showLivewireDelete = false;
    public $showLivewireReset = false;

    public $getUser;

    public $paginate = 15;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'stored' => 'handleStored',
        'deleted' => 'handleDeleted',
        'reseted' => 'handleResetPassword',

        'closeLivewire' => 'handleCloseLivewire',
        'resetSuccess'
    ];

    // create
    public function create()
    {
        $this->showLivewireCreate = true;
    }
    public function handleStored()
    {
        $this->showLivewireCreate = false;
    }

    // delete
    public function delete($id)
    {
        $this->showLivewireDelete = true;

        $user = User::where('id', $id)->first();

        $this->getUser = $user->id;
    }

    public function handleDeleted()
    {
        $this->showLivewireDelete = false;
    }

    public function handleCloseLivewire()
    {
        $this->showLivewireCreate = false;
        $this->showLivewireDelete = false;
    }

    // reset
    public function resetPassword($id)
    {
        User::where('id', $id)->update([
            'password' => password_hash('12345678', PASSWORD_DEFAULT)
        ]);

        $this->emit('resetSuccess');

        session()->flash('message', 'success/Reset password berhasil. Password sekarang adalah 12345678');
    }

    public function resetSuccess()
    {
    }

    public function render()
    {
        return view('livewire.dashboard.user.index', [
            'title' => 'PT. MATRIECS CIPTA ANUGERAH | Dashboard - Daftar User',
            'icon' => '<i class="bi bi-person-check-fill"></i>',
            'title_page' => 'Daftar User',

            'auth' => auth()->user(),
            'user' => $this->search == null ?
                User::orderBy('level')->paginate($this->paginate) :
                User::where('nama', 'like', '%' . $this->search . '%')->orderBy('level')->paginate($this->paginate)
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
