<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class WebpayPlusMallDeferredController extends Controller
{
    const COMMERCE_CODE = "597055555581";
    const API_KEY = "579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C";
    private MallTransaction $mallTransaction;
    public function __construct()
    {
        $option = new Options(self::API_KEY, self::COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $this->mallTransaction = new mallTransaction($option);
    }

    public function create()
    {

        $createTx = [
            'buy_order' => "O-" . rand(1, 10000),
            "session_id" => "S-" . rand(1, 10000),
            'return_url' => url('/') . '/webpay-mall-diferido/commit',
            'details' => [
                [
                    "amount" => 10000,
                    "commerce_code" => 597055555582,
                    "buy_order" => "ordenCompraDetalle" . rand(1, 10000)
                ],
                [
                    "amount" => 12000,
                    "commerce_code" => 597055555583,
                    "buy_order" => "ordenCompraDetalle" . rand(1, 10000)
                ],
            ]
        ];


        $resp = $this->mallTransaction->create($createTx["buy_order"], $createTx["session_id"],  $createTx["return_url"], $createTx["details"]);


        return view('webpay-mall-deferred.create', ["request" => $createTx, "resp" => $resp]);
    }



    public function commit(Request $request)
    {
        //Timeout
        $view = 'webpay-mall-deferred.timeout';
        $data = ["request" => $request];

        //flujo error
        if ($request->exists("TBK_TOKEN") && $request->exists("token_ws")) {
            $view = 'webpay-mall-deferred.error';
        }
        //Pago abortados
        elseif ($request->exists("TBK_TOKEN")) {
            $view = 'webpay-mall-deferred.error';
        }
        //Flujo normal
        elseif ($request->exists("token_ws")) {
            $resp = $this->mallTransaction->commit($request["token_ws"]);
            $view = 'webpay-mall-deferred.commit';
            $data = ["resp" => $resp, "token" => $request["token_ws"]];
        }

        return view($view, $data);
    }


    public function status(Request $request)
    {
        $req = $request->except('_token');
        $resp = $this->mallTransaction->status($req["token"]);
        return view('webpay-mall-deferred.status', ["resp" => $resp, "req" => $req]);
    }

    public function refund(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->mallTransaction->refund($req["token"], $req["buyOrder"], $req["childCommerceCode"], $req["amount"]);
        } catch (\Exception $e) {
            $resp = array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
            return view('webpay-mall-deferred.refund', ["resp" => $resp, "req" => $req]);
        }
        return view('webpay-mall-deferred.refund', ["resp" => $resp, "req" => $req]);
    }

    public function capture(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->mallTransaction->capture($req["childCommerceCode"], $req["token"], $req["buyOrder"], $req["authorizationCode"], $req["amount"]);
        } catch (\Exception $e) {
            $resp = array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
            return view('webpay-mall-deferred.capture', ["resp" => $resp, "request" => $req]);
        }
        return view('webpay-mall-deferred.capture', ["resp" => $resp, "request" => $req]);
    }
}
