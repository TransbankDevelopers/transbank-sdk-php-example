<?php

namespace App\Livewire;

use Transbank\Webpay\Oneclick\MallInscription;
use Transbank\Webpay\Options;

class PromotionsOneclickToken extends OneclickToken
{
    protected function getProduct()
    {
        $option = new Options(
            config('app.transbank.oneclick_promotions_api_key'),
            config('app.transbank.oneclick_promotions_cc'),
            Options::ENVIRONMENT_INTEGRATION
        );

        return new MallInscription($option);
    }
}
