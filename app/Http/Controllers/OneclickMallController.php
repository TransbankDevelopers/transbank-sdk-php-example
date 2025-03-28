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
            $view = 'error-page';
            $data = ["error" => $request];
            $params = $request->only(['TBK_ORDEN_COMPRA', 'TBK_TOKEN', 'TBK_ID_SESION']);
            $token = $request["TBK_TOKEN"];
            $userName = session('username', '');

            if ($request->exists("TBK_ORDEN_COMPRA")) {
                return view('oneclick-mall.recoverTransaction', ["req" => $params]);
            }

            $resp = $this->mallInscription->finish($token);

            if ($resp->responseCode == self::REJECTED) {
                $view = 'oneclick-mall.rejected';
                $data = ["resp" => $resp, "token" => $token];
            } elseif ($resp->responseCode == self::TIMEOUT) {
                $view = 'oneclick-mall.timeout';
                $data = ["resp" => $resp];
            } else {
                $table = [
                    "username" => $userName,
                    "tbk_user" => $resp->tbkUser,
                ];
                $data = ["resp" => $resp, "token" => $token, "table" => $table];
                $view = 'oneclick-mall.finish';
            }

            return view($view, $data);
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
            $tbkUser = $request->post('tbkUser', '');
            $userName = $request->post('userName', '');
            $buyOrder = "O-" . random_int(1000, 9999);
            $amountCommerce1 = $request->post('amountCommerce1', 1693);
            $installmentsCommerce1 = $request->post('installmentsCommerce1', 1);
            $amountCommerce2 = $request->post('amountCommerce2', 1960);
            $installmentsCommerce2 = $request->post('installmentsCommerce2', 1);
            $details = [
                [
                    "commerce_code" => "597055555542",
                    "buy_order" => "O1-" . random_int(1000, 9999),
                    "amount" => $amountCommerce1,
                    "installments_number" => $installmentsCommerce1
                ],
                [
                    "commerce_code" => "597055555543",
                    "buy_order" => "O2-" . random_int(1000, 9999),
                    "amount" => $amountCommerce2,
                    "installments_number" => $installmentsCommerce2
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

            return view('oneclick-mall.refund', ["resp" => $resp, "buyOrder" => $buyOrder]);
        } catch (\Exception $e) {
            $error = ["msg" => $e->getMessage(), "code" => $e->getCode()];
            return view('error-page', ["error" => $error]);
        }
    }
}
