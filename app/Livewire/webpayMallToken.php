<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\WebpayPlusMallController;

class WebpayMallToken extends Component
{
    public $token;
    public $buyOrder;
    public $sessionId;
    public $returnUrl;
    public $details;
    public $tokenName = 'token_ws';

    public function updateToken()
    {
        $controller = $this->getController();
        $transaction = $controller->createTransaction(
            $this->buyOrder,
            $this->sessionId,
            $this->returnUrl,
            $this->details
        );
        $this->token = $transaction->getToken();
    }

    protected function getController()
    {
        return new WebpayPlusMallController();
    }

    public function render()
    {
        return view('livewire.token');
    }
}
