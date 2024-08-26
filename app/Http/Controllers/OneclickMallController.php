<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\Oneclick\MallInscription;
use Transbank\Webpay\Oneclick\MallTransaction;

class OneclickMallController extends Controller
{

    const  TIMEOUT = -96;
    const REJECTED = -1;
    const COMMERCE_CODE = "597055555541";
    const API_KEY = "579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C";
    private MallInscription $mallInscription;
    private MallTransaction $mallTransaction;

    public function __construct()
    {
        $option = new Options(self::API_KEY, self::COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $this->mallInscription = new MallInscription($option);
        $this->mallTransaction = new MallTransaction($option);
    }

    public function startInscription()
    {
        try {

            $startTx = [
                "username" => "User-" . random_int(1, 10000),
                "email" => "user." . random_int(1, 10000) . "@example.cl",
                "response_url" => url("/") . "/oneclick-mall/finish"
            ];

            session(['username' => $startTx["username"]]);
            $resp = $this->mallInscription->start($startTx["username"], $startTx["email"], $startTx["response_url"]);
            return view('oneclick-mall.start', ["request" => $startTx, "resp" => $resp]);
        } catch (\Exception $e) {
            $error = ["msg" => $e->getMessage(), "code" => $e->getCode()];
            return view('error-page', ["error" => $error]);
        }
    }

    public function finishInscription(Request $request)
    {
        try {
            //flujo error
            if ($request->exists("TBK_ORDEN_COMPRA")) {
                return view('error-page');
            }

            $token = $request["TBK_TOKEN"];
            $userName = session('username', '');
            $resp = $this->mallInscription->finish($token);


            if ($resp->responseCode == self::REJECTED) {
                return view('oneclick-mall.rejected', ["resp" => $resp, "token" => $token]);
            }

            if ($resp->responseCode == self::TIMEOUT) {
                return view('oneclick-mall.timeout', ["resp" => $resp]);
            }

            $table = [
                "username" => $userName,
                "tbk_user" => $resp->tbkUser,
            ];
            return view('oneclick-mall.finish', ["resp" => $resp, "token" => $token, "table" => $table]);
        } catch (\Exception $e) {
            $error = ["msg" => $e->getMessage(), "code" => $e->getCode()];
            return view('error-page', ["error" => $error]);
        }
    }
    public function deleteInscription(Request $request)
    {
        try {
            $tbkUser = $request["tbkUser"];
            $userName = $request["userName"];
            $resp = $this->mallInscription->delete($tbkUser, $userName);
            return view('oneclick-mall.delete', ["resp" => $resp]);
        } catch (\Exception $e) {
            $error = ["msg" => $e->getMessage(), "code" => $e->getCode()];
            return view('error-page', ["error" => $error]);
        }
    }

    public function authorizeMall(Request $request)
    {
        try {
            $tbkUser = $request["tbkUser"];
            $userName = $request["userName"];
            $buyOrder = "O-" . random_int(1000, 9999);
            $details = [
                [
                    "commerce_code" => "597055555542",
                    "buy_order" => "O1-" . random_int(1000, 9999),
                    "amount" => 1693,
                    "installments_number" => 1
                ],
                [
                    "commerce_code" => "597055555543",
                    "buy_order" => "O2-" . random_int(1000, 9999),
                    "amount" => 1960,
                    "installments_number" => 1
                ]
            ];

            $resp = $this->mallTransaction->authorize($userName, $tbkUser, $buyOrder, $details);
            return view('oneclick-mall.authorize', ["resp" => $resp]);
        } catch (\Exception $e) {
            $error = ["msg" => $e->getMessage(), "code" => $e->getCode()];
            return view('error-page', ["error" => $error]);
        }
    }

    public function status(Request $request)
    {
        try {
            $buyOrder = $request["buyOrder"];
            $resp = $this->mallTransaction->status($buyOrder);
            return view('oneclick-mall.status', ["resp" => $resp]);
        } catch (\Exception $e) {
            $error = ["msg" => $e->getMessage(), "code" => $e->getCode()];
            return view('error-page', ["error" => $error]);
        }
    }

    public function refund(Request $request)
    {
        try {
            $req = $request->except('_token');
            $buyOrder = $req["buyOrder"];
            $childCommerceCode = $req["childCommerceCode"];
            $childBuyOrder = $req["childBuyOrder"];
            $amount = $req["amount"];

            $resp = $this->mallTransaction->refund($buyOrder, $childCommerceCode, $childBuyOrder, $amount);

            return view('oneclick-mall.refund', ["resp" => $resp]);
        } catch (\Exception $e) {
            $error = ["msg" => $e->getMessage(), "code" => $e->getCode()];
            return view('error-page', ["error" => $error]);
        }
    }
}
