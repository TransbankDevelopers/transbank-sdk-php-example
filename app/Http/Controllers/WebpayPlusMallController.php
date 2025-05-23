<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class WebpayPlusMallController extends Controller
{
    private MallTransaction $mallTransaction;
    const PRODUCT = 'Webpay Plus Mall';
    public function __construct()
    {
        $apiKey = config('app.transbank.webpay_api_key');
        $commerceCode = config('app.transbank.webpay_plus_mall_cc');
        $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
        $this->mallTransaction = new mallTransaction($option);
    }

    public function create()
    {

        try {
            $createTx = [
                "buy_order" => "O-" . random_int(1, 10000),
                "session_id" => "S-" . random_int(1, 10000),
                "return_url" => url("/") . "/webpay-mall/commit",
                "details" => [
                    [
                        "amount" => 10000,
                        "commerce_code" => 597055555536,
                        "buy_order" => "ordenCompraDetalle" . random_int(1, 10000)
                    ],
                    [
                        "amount" => 12000,
                        "commerce_code" => 597055555537,
                        "buy_order" => "ordenCompraDetalle" . random_int(1, 10000)
                    ],
                ]
            ];

            $resp = $this->mallTransaction->create($createTx["buy_order"], $createTx["session_id"], $createTx["return_url"], $createTx["details"]);
            return view('webpay-mall.create', ["request" => $createTx, "resp" => $resp]);
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
                $data["resp"] = $this->mallTransaction->status($request["TBK_TOKEN"]);
            }
            //Flujo normal
            elseif ($request->exists("token_ws")) {
                $resp = $this->mallTransaction->commit($request["token_ws"]);
                $view = 'webpay-mall.commit';
                $data = ["resp" => $resp, "token" => $request["token_ws"]];
            }
            return view($view, $data);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }


    public function status(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->mallTransaction->status($req["token"]);
            return view('webpay-mall.status', ["resp" => $resp, "req" => $req]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function refund(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->mallTransaction->refund($req["token"], $req["buyOrder"], $req["childCommerceCode"], $req["amount"]);
            return view('webpay-mall.refund', ["resp" => $resp, "req" => $req, "token" => $req["token"]]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function showOperations()
    {
        $webpayPlusMallStatus = config('webpayParams.webpay_plus_mall_status');
        $webpayPlusMallRefund = config('webpayParams.webpay_plus_mall_refund');

        return view('webpay-mall.api-operations', compact(
            'webpayPlusMallStatus',
            'webpayPlusMallRefund'
        ));
    }
}
