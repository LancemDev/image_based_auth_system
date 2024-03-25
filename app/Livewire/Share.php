<?php

namespace App\Livewire;

use Livewire\Component;

class Share extends Component
{
    public $link;
    public function share($url)
    {
        $this->link = url;
    }
    public function render()
    {
        return view('livewire.share');
    }
}
