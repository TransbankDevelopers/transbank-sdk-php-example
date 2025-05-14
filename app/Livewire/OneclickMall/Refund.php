<?php

namespace App\Livewire\OneclickMall;

use Livewire\Component;
use Transbank\Webpay\Oneclick\MallTransaction;
use Transbank\Webpay\Options;

class Refund extends Component
{
    public $buyOrder = '';
    public $childCommerceCode = '';
    public $childBuyOrder = '';
    public $amount = '';
    public $refundResponse = null;

    public function refund()
    {
        try {
            $apiKey = config('app.transbank.webpay_api_key');
            $commerceCode = config('app.transbank.oneclick_cc');
            $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
            $mallTransaction = new MallTransaction($option);
            $response = $mallTransaction->refund($this->buyOrder, $this->childCommerceCode, $this->childBuyOrder, $this->amount);
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
        return view('livewire.oneclick-mall.refund');
    }
}
