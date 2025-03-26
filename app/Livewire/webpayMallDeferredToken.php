<?php

namespace App\Livewire;

use App\Http\Controllers\WebpayPlusMallDeferredController;

class WebpayMallDeferredToken extends WebpayMallToken
{
    protected function getController()
    {
        return new WebpayPlusMallDeferredController();
    }
}
