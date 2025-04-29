<?php

namespace App\Livewire\WebpayMall;

use Livewire\Component;
use Transbank\Webpay\WebpayPlus\MallTransaction;
use Transbank\Webpay\Options;

class Refund extends Component
{
    public $token = '';
    public $amount = '';
    public $buyOrder = '';
    public $childCommerceCode = '';
    public $refundResponse = null;

    public function refund()
    {
        try {
            $option = new Options(
                config('app.transbank.webpay_api_key'),
                config('app.transbank.webpay_plus_mall_cc'),
                Options::ENVIRONMENT_INTEGRATION
            );
            $transaction = new MallTransaction($option);
            $response = $transaction->refund($this->token, $this->buyOrder, $this->childCommerceCode, $this->amount);
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
        return view('livewire.webpay-mall.refund');
    }
}
