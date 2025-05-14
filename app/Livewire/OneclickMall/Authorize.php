<?php

namespace App\Livewire\OneclickMall;

use Livewire\Component;
use Transbank\Webpay\Oneclick\MallTransaction;
use Transbank\Webpay\Options;

class Authorize extends Component
{
    public $tbkUser = '';

    public $buyOrder = '';
    public $userName = '';
    public $commerceCode1 = '';
    public $buyOrder1 = '';
    public $amount1 = '';
    public $installments1 = '';
    public $commerceCode2 = '';
    public $buyOrder2 = '';
    public $amount2 = '';
    public $installments2 = '';
    public $authorizeResponse = null;

    public function authorizeTransaction()
    {
        try {
            $apiKey = config('app.transbank.webpay_api_key');
            $commerceCode = config('app.transbank.oneclick_cc');
            $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
            $mallTransaction = new MallTransaction($option);

            $buyOrder = $this->buyOrder;
            $details = [
                [
                    "commerce_code" => $this->commerceCode1,
                    "buy_order" => $this->buyOrder1,
                    "amount" => $this->amount1,
                    "installments_number" => $this->installments1
                ]
            ];

            if ($this->commerceCode2 && $this->buyOrder2 && $this->amount2) {
                $details[] = [
                    "commerce_code" => $this->commerceCode2,
                    "buy_order" => $this->buyOrder2,
                    "amount" => $this->amount2,
                    "installments_number" => $this->installments2
                ];
            }
            $response = $mallTransaction->authorize($this->userName, $this->tbkUser, $buyOrder, $details);
            $this->authorizeResponse = json_decode(json_encode($response), true);

            $this->dispatch('snippet-response-updated');
        } catch (\Exception $e) {
            $this->authorizeResponse = [
                'error' => $e->getMessage()
            ];
            $this->dispatch('snippet-response-updated');
        }
    }

    public function render()
    {
        return view('livewire.oneclick-mall.authorize');
    }
}
