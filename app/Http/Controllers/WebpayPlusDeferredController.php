<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;

class WebpayPlusDeferredController extends Controller
{
    const COMMERCE_CODE = "597055555540";
    const API_KEY = "579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C";
    private Transaction $transaction;

    public function __construct()
    {
        $option = new Options(self::API_KEY, self::COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $this->transaction = new Transaction($option);
    }

    public function create()
    {

        $createTx = [
            'buyOrder' => "O-" . rand(1, 10000),
            "sessionId" => "S-" . (string)(rand(1, 10000)),
            'returnUrl' => url('/') . '/webpay-plus-diferido/commit',
            'amount' => rand(1000, 2000)
        ];


        $resp = $this->transaction->create($createTx['buyOrder'], $createTx['sessionId'], $createTx['amount'], $createTx['returnUrl']);
        return view('webpay-deferred.create', ["request" => $createTx, "respond" => $resp]);
    }
    public function commit(Request $request)
    {
        //Timeout
        $view = 'webpay-deferred.timeout';
        $data = ["request" => $request];

        //flujo error
        if ($request->exists("TBK_TOKEN") && $request->exists("token_ws")) {
            $view = 'webpay-deferred.error';
        }
        //Pago abortadoas
        elseif ($request->exists("TBK_TOKEN")) {
            $view = 'webpay-deferred.error';
        }
        //Flujo normal
        elseif ($request->exists("token_ws")) {
            $resp = $this->transaction->commit($request["token_ws"]);
            $view = 'webpay-deferred.commit';
            $data = ["resp" => $resp, "token" => $request["token_ws"]];
        }

        return view($view, $data);
    }

    public function capture(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->capture($req["token"], $req["buyOrder"], $req["authorizationCode"], $req["amount"]);
        } catch (\Exception $e) {
            $resp = array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
            return view('webpay-deferred.capture', ["resp" => $resp, "token" => $req["token"]]);
        }
        return view('webpay-deferred.capture', ["resp" => $resp, "token" => $req["token"]]);
    }

    public function refund(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->refund($req["token"], $req["amount"]);
        } catch (\Exception $e) {
            $resp = array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
            return view('webpay-deferred.refund', ["resp" => $resp]);
        }
        return view('webpay-deferred.refund', ["resp" => $resp]);
    }

    public function status(Request $request)
    {
        $token = $request["token"];
        $resp = $this->transaction->status($token);
        return view('webpay-deferred.status', ["resp" => $resp, "req" => $request]);
    }
}
