<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class WebpayPlusMallController extends Controller
{
    const COMMERCE_CODE = "597055555535";
    const API_KEY = "579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C";
    private MallTransaction $MallTransaction;
    public function __construct()
    {
        $option = new Options(self::API_KEY, self::COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $this->MallTransaction = new MallTransaction($option);
    }

    public function create()
    {

        $createTx = [
            'buyOrder' => "O-" . rand(1, 10000),
            "sessionId" => "S-" . (string)(rand(1, 10000)),
            'returnUrl' => url('/') . '/webpay-mall/commit',
        ];
        $detail=[

        ]

        $resp = $this->MallTransaction->create($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"]);

        return view('webpay-mall.create', compact('commerceCodeList'));
    }

    public function createdMallTransaction(Request $request)
    {

        $req = $request->except('_token');
        $resp = (new WebpayPlus\MallTransaction)->create($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"]);

        return view('webpayplus/transaction_created', ["params" => $req, "response" => $resp]);
    }


    public function commitmallTransaction(Request $request)
    {
        //Flujo normal
        if ($request->exists("token_ws")) {
            $req = $request->except('_token');
            $token = $req["token_ws"];
            $resp = (new WebpayPlus\MallTransaction)->commit($token);

            return view('webpayplus/mall_transaction_committed', ["params" => $req, "response" => $resp]);
        }

        //Pago abortado
        if ($request->exists("TBK_TOKEN")) {
            return view('webpayplus/mall_transaction_aborted', ["resp" => $request->all()]);
        }

        //Timeout
        return view('webpayplus/mall_transaction_timeout', ["resp" => $request->all()]);
    }

    public function getMallTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = (new WebpayPlus\MallTransaction)->status($token);

        return view('webpayplus/mall_transaction_status', ["resp" => $resp, "req" => $req]);
    }

    public function refundMallTransaction(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        try {
            $resp = (new WebpayPlus\MallTransaction)->refund($token, $req["buy_order"], $req["commerce_code"], $req["amount"]);
        } catch (WebpayPlus\Exceptions\TransactionRefundException $e) {
            dd($e);
        }


        return view('webpayplus/mall_refund_success', ["req" => $req, "resp" => $resp]);
    }
}
