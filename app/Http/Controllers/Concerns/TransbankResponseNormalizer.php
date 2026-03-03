<?php

namespace App\Http\Controllers\Concerns;

trait TransbankResponseNormalizer
{
    protected function normalizeResponseForSnippet($resp)
    {
        if (is_array($resp)) {
            return $resp;
        }

        if (is_object($resp) && method_exists($resp, 'getBuyOrder')) {
            $details = $resp->getDetails() ?? [];
            $normalizedDetails = array_map(function ($detail) {
                return $this->normalizeDetail($detail);
            }, $details);

            return [
                'buy_order' => $resp->getBuyOrder(),
                'card_detail' => $resp->getCardDetail(),
                'card_number' => $resp->getCardNumber(),
                'accounting_date' => $resp->getAccountingDate(),
                'transaction_date' => $resp->getTransactionDate(),
                'details' => $normalizedDetails
            ];
        }

        return $resp;
    }

    protected function normalizeDetail($detail): array
    {
        if (is_array($detail)) {
            return $detail;
        }

        if (!is_object($detail)) {
            return [];
        }

        $map = [
            'amount' => 'getAmount',
            'status' => 'getStatus',
            'authorization_code' => 'getAuthorizationCode',
            'payment_type_code' => 'getPaymentTypeCode',
            'response_code' => 'getResponseCode',
            'installments_number' => 'getInstallmentsNumber',
            'installments_amount' => 'getInstallmentsAmount',
            'commerce_code' => 'getCommerceCode',
            'buy_order' => 'getBuyOrder',
            'balance' => 'getBalance',
            'prepaid_balance' => 'getPrepaidBalance'
        ];

        $payload = [];
        foreach ($map as $key => $method) {
            if (method_exists($detail, $method)) {
                try {
                    $payload[$key] = $detail->$method();
                } catch (\Error $e) {
                    continue;
                }
            }
        }

        return !empty($payload) ? $payload : get_object_vars($detail);
    }
}
