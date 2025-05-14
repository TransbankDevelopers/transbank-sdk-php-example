<?php

namespace App\Livewire\WebpayMallDeferred;

use Livewire\Component;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class Status extends Component
{
    public $token = '';
    public $statusResponse = null;

    public function getStatus()
    {
        try {
            $apiKey = config('app.transbank.webpay_api_key');
            $commerceCode = config('app.transbank.webpay_plus_mall_deferred_cc');
            $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
            $mallTransaction = new MallTransaction($option);
            $response = $mallTransaction->status($this->token);
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
        return view('livewire.webpay-mall-deferred.status');
    }
}
