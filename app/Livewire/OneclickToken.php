<?php

namespace App\Livewire;

use Transbank\Webpay\Options;
use Transbank\Webpay\Oneclick\MallInscription;

class OneclickToken extends Token
{
    public $userName;
    public $email;
    public $responseUrl;

    public function getToken()
    {
        $product = $this->getProduct();
        $inscription = $product->start(
            $this->userName,
            $this->email,
            $this->responseUrl,
        );
        return $inscription->getToken();
    }

    protected function setTokenName()
    {
        $this->tokenName = 'TBK_TOKEN';
    }

    protected function getProduct()
    {
        $option = new Options(
            config('app.transbank.webpay_api_key'),
            config('app.transbank.oneclick_cc'),
            Options::ENVIRONMENT_INTEGRATION
        );
        return new MallInscription($option);
    }
}
