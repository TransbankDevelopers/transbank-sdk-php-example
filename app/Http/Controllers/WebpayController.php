<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;



class WebpayController extends Controller
{
    private Transaction $transaction;
    const PRODUCT = 'Webpay Plus';

    public function __construct()
    {
        $apiKey = config('app.transbank.webpay_api_key');
        $commerceCode = config('app.transbank.webpay_plus_cc');
        $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
        $this->transaction = new Transaction($option);
    }

    public function create()
    {

        try {
            $createTx = [
                'buyOrder' => "O-" . random_int(1, 10000),
                "sessionId" => "S-" . random_int(1, 10000),
                'returnUrl' => url('/') . '/webpay-plus/commit',
                'amount' => random_int(1000, 2000)
            ];

            $resp = $this->transaction->create($createTx['buyOrder'], $createTx['sessionId'], $createTx['amount'], $createTx['returnUrl']);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }

        return view('webpay.create', ["request" => $createTx, "respond" => $resp]);
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
            //Pago abortadas
            elseif ($request->exists("TBK_TOKEN")) {
                $view = 'error.webpay.aborted';
                $data["resp"] = $this->transaction->status($request["TBK_TOKEN"]);
            }
            //Flujo normal
            elseif ($request->exists("token_ws")) {
                $resp = $this->transaction->commit($request["token_ws"]);
                $view = 'webpay.commit';
                $data = ["resp" => $resp, "token" => $request["token_ws"]];
            }
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }

        return view($view, $data);
    }

    public function refund(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->refund($req["token"], $req["amount"]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
        return view('webpay.refund', ["resp" => $resp, 'token' => $req["token"]]);
    }

    public function status(Request $request)
    {
        try {
            $token = $request["token"];
            $resp = $this->transaction->status($token);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
        return view('webpay.status', ["resp" => $resp, "req" => $request]);
    }
}
