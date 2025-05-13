<?php

namespace App\Livewire\OneclickMallDeferred;

use Livewire\Component;
use Transbank\Webpay\Oneclick\MallTransaction;
use Transbank\Webpay\Options;

class Capture extends Component
{
    public $childCommerceCode = '';
    public $childBuyOrder = '';
    public $authorizationCode = '';
    public $amount = '';
    public $captureResponse = null;

    public function captureTransaction()
    {
        try {
            $apiKey = config('app.transbank.webpay_api_key');
            $commerceCode = config('app.transbank.oneclick_deferred_cc');
            $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
            $mallTransaction = new MallTransaction($option);

            $response = $mallTransaction->capture(
                $this->childCommerceCode,
                $this->childBuyOrder,
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
        return view('livewire.oneclick-mall-deferred.capture');
    }
}
