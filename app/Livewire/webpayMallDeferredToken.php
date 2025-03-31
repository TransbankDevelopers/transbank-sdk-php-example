<?php

namespace App\Livewire;

use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class WebpayMallDeferredToken extends WebpayMallToken
{
    protected function getProduct(): MallTransaction
    {
        $option = new Options(
            config('app.transbank.webpay_api_key'),
            config('app.transbank.webpay_plus_mall_deferred_cc'),
            Options::ENVIRONMENT_INTEGRATION
        );
        return new MallTransaction($option);
    }
}
