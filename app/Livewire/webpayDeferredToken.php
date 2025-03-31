<?php

namespace App\Livewire;

use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;

class WebpayDeferredToken extends WebpayToken
{
    protected function getProduct()
    {
        $option = new Options(
            config('app.transbank.webpay_api_key'),
            config('app.transbank.webpay_plus_deferred_cc'),
            Options::ENVIRONMENT_INTEGRATION
        );
        return new Transaction($option);
    }
}
