<?php

namespace App\Livewire\Webpay;

use Livewire\Component;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;

class Refund extends Component
{
    public $token = '';
    public $amount = '';
    public $refundResponse = null;

    public function refund()
    {
        try {
            $option = new Options(
                config('app.transbank.webpay_api_key'),
                config('app.transbank.webpay_plus_cc'),
                Options::ENVIRONMENT_INTEGRATION
            );
            $transaction = new Transaction($option);
            $response = $transaction->refund($this->token, $this->amount);
            $this->refundResponse = json_decode(json_encode($response), true);

            $this->dispatch('snippet-response-updated');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al realizar el reembolso: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.webpay.refund');
    }
}
