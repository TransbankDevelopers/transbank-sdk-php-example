<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\TransaccionCompleta;
use Transbank\Webpay\TransaccionCompleta\MallTransaction;

class TransaccionCompletaMall extends Controller
{
    private MallTransaction $transaction;
    private const SESSION_DETAILS = 'transaccion_completa_mall_details';
    const PRODUCT = 'Transaccion Completa Mall';

    public function __construct()
    {
        $apiKey = config('app.transbank.webpay_api_key');
        $commerceCode = TransaccionCompleta::INTEGRATION_MALL_COMMERCE_CODE;
        $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
        $this->transaction = new MallTransaction($option);
    }

    public function index()
    {
        return view('transaccion-completa-mall.index');
    }

    public function create(Request $request)
    {
        try {
            $req = $request->except('_token');
            $cardNumberClean = str_replace(' ', '', $req['number']);
            $parts = explode('/', $req['expiry']);
            $month = $parts[0] ?? '';
            $year = $parts[1] ?? '';
            $cardExpiryFormatted = $year . '/' . $month;

            $details = $this->buildMallDetails();

            $createTx = [
                'buyOrder' => "O-" . random_int(1, 10000),
                "sessionId" => "S-" . random_int(1, 10000),
                'details' => $details
            ];

            $resp = $this->transaction->create(
                $createTx['buyOrder'],
                $createTx['sessionId'],
                $cardNumberClean,
                $cardExpiryFormatted,
                $createTx['details'],
                $req['cvc']
            );

            session([self::SESSION_DETAILS => $details]);

            return view('transaccion-completa-mall.create', [
                "request" => $createTx,
                "respond" => $resp
            ]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function installments(Request $request)
    {
        try {
            $req = $request->except('_token');
            $details = session(self::SESSION_DETAILS);

            if (empty($details)) {
                return view('error-page', ["error" => "No hay detalles de la transacción en sesión."]);
            }

            $installmentDetails = array_map(function ($detail) use ($req) {
                return [
                    'commerce_code' => $detail['commerce_code'],
                    'buy_order' => $detail['buy_order'],
                    'installments_number' => $req['installments_number']
                ];
            }, $details);

            $resp = $this->transaction->installments($req['token'], $installmentDetails);

            return view('transaccion-completa-mall.installments', [
                "request" => $req,
                "respond" => $resp
            ]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function commit(Request $request)
    {
        try {
            $req = $request->except('_token');
            $details = session(self::SESSION_DETAILS);

            if (empty($details)) {
                return view('error-page', ["error" => "No hay detalles de la transacción en sesión."]);
            }

            $commitDetails = array_map(function ($detail) use ($req) {
                $payload = [
                    'commerce_code' => $detail['commerce_code'],
                    'buy_order' => $detail['buy_order']
                ];

                if (!empty($req['idQueryInstallments'])) {
                    $payload['id_query_installments'] = $req['idQueryInstallments'];
                }
                if (!empty($req['deferredPeriodIndex'])) {
                    $payload['deferred_period_index'] = $req['deferredPeriodIndex'];
                }
                if (isset($req['gracePeriod']) && $req['gracePeriod'] !== '') {
                    $gracePeriod = filter_var(
                        $req['gracePeriod'],
                        FILTER_VALIDATE_BOOLEAN,
                        FILTER_NULL_ON_FAILURE
                    );
                    $payload['grace_period'] = $gracePeriod ?? $req['gracePeriod'];
                }

                return $payload;
            }, $details);

            $resp = $this->transaction->commit($req['token'], $commitDetails);
            $respondPayload = $this->normalizeResponseForSnippet($resp);

            $responseDetails = [];
            $rawDetails = $resp->getDetails() ?? [];
            foreach ($rawDetails as $detail) {
                $responseDetails[] = $this->normalizeDetail($detail);
            }

            return view('transaccion-completa-mall.commit', [
                "request" => $req,
                "respond" => $resp,
                "respond_payload" => $respondPayload,
                "response_details" => $responseDetails
            ]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function status(Request $request)
    {
        try {

            $req = $request->except('_token');
            $resp = $this->transaction->status($req['token']);
            logger()->info('TCM status response', ['response' => $resp]);
            $respondPayload = $this->normalizeResponseForSnippet($resp);

            return view('transaccion-completa-mall.status', [
                "request" => $req,
                "respond" => $resp,
                "respond_payload" => $respondPayload
            ]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function refund(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->refund(
                $req['token'],
                $req['buyOrder'],
                $req['childCommerceCode'],
                $req['amount']
            );

            return view('transaccion-completa-mall.refund', [
                "request" => $req,
                "respond" => $resp
            ]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    private function buildMallDetails(): array
    {
        $childCommerceCodes = [
            TransaccionCompleta::INTEGRATION_MALL_CHILD_COMMERCE_CODE_1,
            TransaccionCompleta::INTEGRATION_MALL_CHILD_COMMERCE_CODE_2
        ];

        $details = [];
        foreach ($childCommerceCodes as $commerceCode) {
            $details[] = [
                'amount' => random_int(1001, 2000),
                'commerce_code' => $commerceCode,
                'buy_order' => "O-" . random_int(1, 10000)
            ];
        }

        return $details;
    }

    private function normalizeResponseForSnippet($resp)
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

    private function normalizeDetail($detail): array
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
