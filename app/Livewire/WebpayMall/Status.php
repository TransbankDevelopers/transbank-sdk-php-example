<?php

namespace App\Livewire\WebpayMall;

use Livewire\Component;
use Transbank\Webpay\WebpayPlus\MallTransaction;
use Transbank\Webpay\Options;

class Status extends Component
{
    public $token = '';
    public $statusResponse = null;

    public function checkStatus()
    {
        try {
            $option = new Options(
                config('app.transbank.webpay_api_key'),
                config('app.transbank.webpay_plus_mall_cc'),
                Options::ENVIRONMENT_INTEGRATION
            );
            $transaction = new MallTransaction($option);
            $response = $transaction->status($this->token);
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
        return view('livewire.webpay-mall.status');
    }
}
