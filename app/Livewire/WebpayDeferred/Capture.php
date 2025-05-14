<?php

namespace App\Livewire\WebpayDeferred;

use Livewire\Component;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;

class Capture extends Component
{
    public $token = '';
    public $buyOrder = '';
    public $authorizationCode = '';
    public $amount = '';
    public $captureResponse = null;

    public function capture()
    {
        try {
            $option = new Options(
                config('app.transbank.webpay_api_key'),
                config('app.transbank.webpay_plus_deferred_cc'),
                Options::ENVIRONMENT_INTEGRATION
            );
            $transaction = new Transaction($option);
            $response = $transaction->capture(
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
        return view('livewire.webpay-deferred.capture');
    }
}
