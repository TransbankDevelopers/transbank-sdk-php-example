<?php

namespace App\Livewire;

use Transbank\Webpay\Oneclick\MallInscription;
use Transbank\Webpay\Options;

class PromotionsOneclickToken extends OneclickToken
{
    protected function getProduct()
    {
        $option = new Options(
            'd8f06df8-39c7-4f01-8e74-b383c19ae836',
            '597060000001',
            Options::ENVIRONMENT_INTEGRATION
        );

        return new MallInscription($option);
    }
}
