<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;

class Profile extends Component
{
    use Toast;
    public $username;
    public $email;
    // protected $listeners = ['refreshComponent' => '$refresh'];
    public function update()
    {
        $this->validate([
            'username' => 'required|min:6',
            'email' => 'required|email',
        ]);
        auth()->user()->update([
            'name' => $this->username,
            'email' => $this->email,
        ]);
        $this->success('Profile Updated Successfully');
        // $this->emit('refreshComponent');
    }
    public function mount()
    {
        $this->username = auth()->user()->name;
        $this->email = auth()->user()->email;
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
