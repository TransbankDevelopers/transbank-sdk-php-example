<?php

namespace App\Livewire\WebpayMallDeferred;

use Livewire\Component;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class Refund extends Component
{
    public $token = '';
    public $buyOrder = '';
    public $amount = '';
    public $childCommerceCode = '';
    public $refundResponse = null;

    public function refund()
    {
        try {
            $apiKey = config('app.transbank.webpay_api_key');
            $commerceCode = config('app.transbank.webpay_plus_mall_deferred_cc');
            $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
            $mallTransaction = new MallTransaction($option);
            $response = $mallTransaction->refund(
                $this->token,
                $this->buyOrder,
                $this->childCommerceCode,
                $this->amount
            );
            $this->refundResponse = json_decode(json_encode($response), true);
            $this->dispatch('snippet-response-updated');
        } catch (\Exception $e) {
            $this->refundResponse = [
                'error' => $e->getMessage()
            ];
            $this->dispatch('snippet-response-updated');
        }
    }

    public function render()
    {
        return view('livewire.webpay-mall-deferred.refund');
    }
}
