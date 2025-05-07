<?php

namespace App\Livewire\WebpayMallDeferred;

use Livewire\Component;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class Capture extends Component
{
    public $token = '';
    public $buyOrder = '';
    public $authorizationCode = '';
    public $amount = '';
    public $childCommerceCode = '';
    public $captureResponse = null;

    public function capture()
    {
        try {
            $apiKey = config('app.transbank.webpay_api_key');
            $commerceCode = config('app.transbank.webpay_plus_mall_deferred_cc');
            $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
            $mallTransaction = new MallTransaction($option);
            $response = $mallTransaction->capture(
                $this->childCommerceCode,
                $this->token,
                $this->buyOrder,
                $this->authorizationCode,
                $this->amount
            );
            $this->captureResponse = json_decode(json_encode($response), true);
            $this->dispatch('snippet-response-updated');
        } catch (\Exception $e) {
            $this->captureResponse = [
                'error' => $e->getMessage()
            ];
            $this->dispatch('snippet-response-updated');
        }
    }

    public function render()
    {
        return view('livewire.webpay-mall-deferred.capture');
    }
}
