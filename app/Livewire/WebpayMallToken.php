<?php

namespace App\Livewire;

use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class WebpayMallToken extends Token
{
    public $buyOrder;
    public $sessionId;
    public $returnUrl;
    public $details;

    public function getToken()
    {
        $product = $this->getProduct();
        $transaction = $product->create(
            $this->buyOrder,
            $this->sessionId,
            $this->returnUrl,
            $this->details
        );
        return $transaction->getToken();
    }

    protected function setTokenName()
    {
        $this->tokenName = 'token_ws';
    }

    protected function getProduct()
    {
        $option = new Options(
            config('app.transbank.webpay_api_key'),
            config('app.transbank.webpay_plus_mall_cc'),
            Options::ENVIRONMENT_INTEGRATION
        );
        return new mallTransaction($option);
    }
}
