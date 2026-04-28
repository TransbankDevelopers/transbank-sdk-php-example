<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\Oneclick\MallBinInfo;
use Transbank\Webpay\Oneclick\MallInscription;
use Transbank\Webpay\Oneclick\MallTransaction;

class PromotionsOneclickMallController extends Controller
{

    const AUTHORIZED = 0;
    private MallBinInfo $mallBinInfo;
    private MallInscription $mallInscription;
    private MallTransaction $mallTransaction;
    const PRODUCT = 'Oneclick Mall Promociones';

    public function __construct()
    {
        $apiKey = 'd8f06df8-39c7-4f01-8e74-b383c19ae836';
        $commerceCode = '597060000001';
        $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
        $this->mallBinInfo = new MallBinInfo($option);
        $this->mallInscription = new MallInscription($option);
        $this->mallTransaction = new MallTransaction($option);
    }

    public function startInscription()
    {
        try {

            $startTx = [
                "username" => "User-" . random_int(1, 10000),
                "email" => "user." . random_int(1, 10000) . "@example.cl",
                "response_url" => url("/") . "/promotions-oneclick-mall/finish"
            ];

            session(['username' => $startTx["username"]]);
            $resp = $this->mallInscription->start($startTx["username"], $startTx["email"], $startTx["response_url"]);
            return view('promotions-oneclick-mall.start', ["request" => $startTx, "resp" => $resp]);
        } catch (\Exception $e) {
            return $this->renderErrorPage($e);
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
                return view('error.oneclick.recover', ["req" => $params, "product" => self::PRODUCT]);
            }

            $resp = $this->mallInscription->finish($token);

            if ($resp->responseCode != self::AUTHORIZED) {
                $view = 'error.oneclick.rejected';
                $data = ["resp" => $resp, "token" => $token, "product" => self::PRODUCT];
            } else {
                $table = [
                    "username" => $userName,
                    "tbk_user" => $resp->tbkUser,
                ];
                $data = ["resp" => $resp, "token" => $token, "table" => $table];
                $view = 'promotions-oneclick-mall.finish';
            }

            return view($view, $data);
        } catch (\Exception $e) {
            return $this->renderErrorPage($e);
        }
    }
    public function deleteInscription(Request $request)
    {
        try {
            $tbkUser = $request["tbkUser"];
            $userName = $request["userName"];
            $resp = $this->mallInscription->delete($tbkUser, $userName);
            return view('promotions-oneclick-mall.delete', ["resp" => $resp]);
        } catch (\Exception $e) {
            return $this->renderErrorPage($e);
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
                    "commerce_code" => "597060000002",
                    "buy_order" => "O1-" . random_int(1000, 9999),
                    "amount" => $amountCommerce1,
                    "installments_number" => $installmentsCommerce1
                ],
                [
                    "commerce_code" => "597060000003",
                    "buy_order" => "O2-" . random_int(1000, 9999),
                    "amount" => $amountCommerce2,
                    "installments_number" => $installmentsCommerce2
                ]
            ];

            $resp = $this->mallTransaction->authorize($userName, $tbkUser, $buyOrder, $details);
            return view('promotions-oneclick-mall.authorize', ["resp" => $resp]);
        } catch (\Exception $e) {
            return $this->renderErrorPage($e);
        }
    }

    public function status(Request $request)
    {
        try {
            $buyOrder = $request["buyOrder"];
            $resp = $this->mallTransaction->status($buyOrder);
            return view('promotions-oneclick-mall.status', ["resp" => $resp, "buyOrder" => $buyOrder]);
        } catch (\Exception $e) {
            return $this->renderErrorPage($e);
        }
    }

    public function infoBin(Request $request)
    {
        try {
            $tbkUser = $request->query('tbk_user', '');
            $resp = $this->mallBinInfo->queryBin($tbkUser);

            return view('promotions-oneclick-mall.info-bin', [
                "resp" => $resp,
                "tbkUser" => $tbkUser,
            ]);
        } catch (\Exception $e) {
            return $this->renderErrorPage($e);
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

            return view('promotions-oneclick-mall.refund', ["resp" => $resp, "buyOrder" => $buyOrder]);
        } catch (\Exception $e) {
            return $this->renderErrorPage($e);
        }
    }
}
