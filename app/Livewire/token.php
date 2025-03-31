<?php

namespace App\Livewire;

use Livewire\Component;

abstract class Token extends Component
{
    public $token;
    public $tokenName;
    public $pollInterval;

    public function mount()
    {
        $this->setTokenName();
        $this->pollInterval = config('app.transbank.poll_interval') . 's';
    }

    abstract public function updateToken();
    abstract protected function setTokenName();
    abstract protected function getProduct();

    public function render()
    {
        return view('livewire.token');
    }
}
