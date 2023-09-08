<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;

class Delete extends Component
{
    public $closeModal = false;

    // data request
    public $level;
    public $nama;
    public $idDelete;

    public $sekolah;
    public $guru;

    public function mount($user)
    {
        $this->idDelete = $user;
    }

    public function destroy($id)
    {
        User::destroy('id', $id);

        $this->emit('deleted');

        $this->closeModal = true;

        session()->flash('message');
    }
    
    public function render()
    {
        return view('livewire.dashboard.user.delete');
    }
}
