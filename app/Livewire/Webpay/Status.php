<?php

namespace App\Livewire\Webpay;

use Livewire\Component;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;

class Status extends Component
{
    public $token = '';
    public $statusResponse = null;
    public $webpayPlusStatus;


    public function checkStatus()
    {
        try {
            $option = new Options(
                config('app.transbank.webpay_api_key'),
                config('app.transbank.webpay_plus_cc'),
                Options::ENVIRONMENT_INTEGRATION
            );
            $transaction = new Transaction($option);
            $response = $transaction->status($this->token);
            $this->statusResponse = json_decode(json_encode($response), true);

            $this->dispatch('snippet-response-updated');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al obtener el estado: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.webpay.status');
    }
}
