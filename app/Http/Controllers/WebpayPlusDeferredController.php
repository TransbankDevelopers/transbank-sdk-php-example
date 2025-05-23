<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;

class WebpayPlusDeferredController extends Controller
{
    private Transaction $transaction;
    const PRODUCT = 'Webpay Plus Diferido';

    public function __construct()
    {
        $apiKey = config('app.transbank.webpay_api_key');
        $commerceCode = config('app.transbank.webpay_plus_deferred_cc');
        $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
        $this->transaction = new Transaction($option);
    }

    public function create()
    {

        try {
            $createTx = [
                'buyOrder' => "O-" . random_int(1, 10000),
                "sessionId" => "S-" . random_int(1, 10000),
                'returnUrl' => url('/') . '/webpay-plus-diferido/commit',
                'amount' => random_int(1000, 2000)
            ];

            $resp = $this->transaction->create($createTx['buyOrder'], $createTx['sessionId'], $createTx['amount'], $createTx['returnUrl']);
            return view('webpay-deferred.create', ["request" => $createTx, "respond" => $resp]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }
    public function commit(Request $request)
    {
        try {
            //Timeout
            $view = 'error.webpay.timeout';
            $data = ["request" => $request, "product" => self::PRODUCT];

            //flujo error
            if ($request->exists("TBK_TOKEN") && $request->exists("token_ws")) {
                $view = 'error.webpay.form-error';
            }
            //Pago abortado
            elseif ($request->exists("TBK_TOKEN")) {
                $view = 'error.webpay.aborted';
                $data["resp"] = $this->transaction->status($request["TBK_TOKEN"]);
            }
            //Flujo normal
            elseif ($request->exists("token_ws")) {
                $resp = $this->transaction->commit($request["token_ws"]);
                $view = 'webpay-deferred.commit';
                $data = ["resp" => $resp, "token" => $request["token_ws"]];
            }
            return view($view, $data);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function capture(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->capture($req["token"], $req["buyOrder"], $req["authorizationCode"], $req["amount"]);
            return view('webpay-deferred.capture', ["resp" => $resp, "token" => $req["token"]]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function refund(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->refund($req["token"], $req["amount"]);
            return view('webpay-deferred.refund', ["resp" => $resp, 'token' => $req["token"]]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function status(Request $request)
    {
        try {
            $token = $request["token"];
            $resp = $this->transaction->status($token);
            return view('webpay-deferred.status', ["resp" => $resp, "req" => $request]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function showOperations()
    {
        $webpayPlusStatus = config('webpayParams.webpay_plus_status');
        $webpayPlusRefund = config('webpayParams.webpay_plus_refund');
        $webpayPlusDeferredCaptured = config('webpayParams.webpay_plus_deferred_captured');

        return view('webpay-deferred.api-operations', compact(
            'webpayPlusStatus',
            'webpayPlusRefund',
            'webpayPlusDeferredCaptured'
        ));
    }
}
