<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;



class WebpayController extends Controller
{
    const COMMERCE_CODE = "597055555532";
    const API_KEY = "579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C";
    private Transaction $transaction;

    public function __construct()
    {
        $option = new Options(self::API_KEY, self::COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $this->transaction = new Transaction($option);
    }

    public function index()
    {

        $createTx = [
            'buyOrder' => "O-" . rand(1, 10000),
            "sessionId" => "S-" . (string)(rand(1, 10000)),
            'returnUrl' => url('/') . '/webpay-plus/commit',
            'amount' => rand(1000, 2000)
        ];
        // $transaction = Transaction::buildForIntegration($commerceCode, $apiKey);

        $resp = $this->transaction->create($createTx['buyOrder'], $createTx['sessionId'], $createTx['amount'], $createTx['returnUrl']);
        return view('webpay.create', ["request" => $createTx, "respond" => $resp]);
    }
    public function commit(Request $request)
    {

        //flujo error
        if ($request->exists("TBK_TOKEN") && $request->exists("token_ws")) {
            return view('webpay.error', ["request" => $request]);
        }

        //Flujo normal
        if ($request->exists("token_ws")) {
            $resp = $this->transaction->commit($request["token_ws"]);
            return view('webpay.commit', ["resp" => $resp, "token" => $request["token_ws"]]);
        }

        //Pago abortadoas
        if ($request->exists("TBK_TOKEN")) {
            return view('webpay.error', ["request" => $request]);
        }

        //Timeout
        return view('webpay.timeout', ["request" => $request]);
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
            return view('webpay.refund', ["resp" => $resp]);
        }
        return view('webpay.refund', ["resp" => $resp]);
    }

    public function status(Request $request)
    {
        $token = $request["token"];
        $resp = $this->transaction->status($token);
        return view('webpay.status', ["resp" => $resp, "req" => $request]);
    }
}
