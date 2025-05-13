<?php

namespace App\Livewire\OneclickMallDeferred;

use Livewire\Component;
use Transbank\Webpay\Oneclick\MallTransaction;
use Transbank\Webpay\Options;

class Status extends Component
{
    public $buyOrder = '';
    public $statusResponse = null;

    public function checkStatus()
    {
        try {
            $apiKey = config('app.transbank.webpay_api_key');
            $commerceCode = config('app.transbank.oneclick_deferred_cc');
            $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
            $mallTransaction = new MallTransaction($option);

            $response = $mallTransaction->status($this->buyOrder);
            $this->statusResponse = json_decode(json_encode($response), true);

            $this->dispatch('snippet-response-updated');
        } catch (\Exception $e) {
            $this->statusResponse = [
                'error' => $e->getMessage()
            ];
            $this->dispatch('snippet-response-updated');
        }
    }

    public function render()
    {
        return view('livewire.oneclick-mall-deferred.status');
    }
}
