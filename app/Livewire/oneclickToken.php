<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\OneclickMallController;

class OneclickToken extends Component
{
    public $token;
    public $userName;
    public $email;
    public $responseUrl;

    public $tokenName = 'TBK_TOKEN';

    public function updateToken()
    {
        $controller = $this->getController();
        $inscription = $controller->createInscription(
            $this->userName,
            $this->email,
            $this->responseUrl,
        );
        $this->token = $inscription->getToken();
    }

    protected function getController()
    {
        return new OneclickMallController();
    }

    public function render()
    {

        return view('livewire.token');
    }
}
