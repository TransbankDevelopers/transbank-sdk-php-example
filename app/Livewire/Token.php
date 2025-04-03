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

    public function updateToken()
    {
        $oldToken = $this->token;
        $this->token = $this->getToken();
        $this->dispatch('token-updated', token: $this->token, oldToken: $oldToken);
    }
    abstract protected function setTokenName();
    abstract protected function getProduct();
    abstract protected function getToken();

    public function render()
    {
        return view('livewire.token');
    }
}
