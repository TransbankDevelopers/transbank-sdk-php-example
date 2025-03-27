<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\WebpayController;

class WebpayToken extends Component
{
    public $token;
    public $buyOrder;
    public $sessionId;
    public $amount;
    public $returnUrl;
    public $tokenName = 'token_ws';

    public function updateToken()
    {
        $controller = $this->getController();
        $transaction = $controller->createTransaction(
            $this->buyOrder,
            $this->sessionId,
            $this->amount,
            $this->returnUrl
        );
        $this->token = $transaction->getToken();
    }

    protected function getController()
    {
        return new WebpayController();
    }
    public function render()
    {
        return view('livewire.token');
    }
}
