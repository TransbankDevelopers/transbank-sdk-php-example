<?php

namespace App\Livewire;

use App\Http\Controllers\WebpayPlusDeferredController;

class WebpayDeferredToken extends WebpayToken
{
    protected function getController()
    {
        return new WebpayPlusDeferredController();
    }
}
