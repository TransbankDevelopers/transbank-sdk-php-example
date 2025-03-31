<?php

namespace App\Livewire;

use Transbank\Webpay\Options;
use Transbank\Webpay\Oneclick\MallInscription;

class OneclickDeferredToken extends OneclickToken
{
    protected function getProduct()
    {
        $option = new Options(
            config('app.transbank.webpay_api_key'),
            config('app.transbank.oneclick_deferred_cc'),
            Options::ENVIRONMENT_INTEGRATION
        );
        return new MallInscription($option);
    }
}
