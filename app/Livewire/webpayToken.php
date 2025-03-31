<?php

namespace App\Livewire;

use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;

class WebpayToken extends Token
{
    public $buyOrder;
    public $sessionId;
    public $amount;
    public $returnUrl;

    public function updateToken()
    {
        $product = $this->getProduct();
        $transaction = $product->create(
            $this->buyOrder,
            $this->sessionId,
            $this->amount,
            $this->returnUrl
        );
        $this->token = $transaction->getToken();
    }

    protected function setTokenName()
    {
        $this->tokenName = 'token_ws';
    }

    protected function getProduct()
    {
        $option = new Options(
            config('app.transbank.webpay_api_key'),
            config('app.transbank.webpay_plus_cc'),
            Options::ENVIRONMENT_INTEGRATION
        );
        return new Transaction($option);
    }
}
