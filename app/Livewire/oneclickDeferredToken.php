<?php

namespace App\Livewire;

use App\Http\Controllers\OneclickMallDeferredController;

class OneclickDeferredToken extends OneclickToken
{
    protected function getController()
    {
        return new OneclickMallDeferredController();
    }
}
