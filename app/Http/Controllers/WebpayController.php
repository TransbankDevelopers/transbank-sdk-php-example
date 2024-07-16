<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

class WebpayController extends Controller
{

    public function __construct(){
        WebpayPlus::configureForTesting();
    }

    public function index(){

        $cretaTx = [
            'buyOrder' => "O-" . rand(1, 10000),
            "sessionId"=> "S-" . (string)(rand(1, 10000)),
            'returnUrl' => url('/') . '/webpay-plus/commit',
            'amount' => rand(1000, 2000)
        ];

        $resp = (new Transaction)->create($cretaTx['buyOrder'], $cretaTx['sessionId'], $cretaTx['amount'], $cretaTx['returnUrl']);
        return view('webpay.create', ["request" => $cretaTx, "respond" => $resp]);
    }
    public function commit(Request $request){
        //Flujo normal
        if($request->exists("token_ws")){
            $resp = (new Transaction)->commit($request["token_ws"]);
            return view('webpay.commit', ["resp" => $resp, "token" => $request["token_ws"]]);
        }

        //Pago abortadoas
        if($request->exists("TBK_TOKEN")){
            return view('webpay.error', ["request" => $request]);
        }

        //Timeout
        return view('webpay.timeout', ["request" => $request]);

    }

    public function refund(Request $request){
        try {
            $req = $request->except('_token');
            $resp = (new Transaction)->refund($req["token"], $req["amount"]);
        } catch (\Exception $e) {
            $resp = array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
            return view('webpay.refund', ["resp" => $resp]);
        }
        return view('webpay.refund', ["resp" => $resp]);
    }

    public function status(Request $request){
        // $req = $request->except('_token');
        $token = $request["token"];
        $resp = (new Transaction)->status($token);
        return view('webpay.status', ["resp" => $resp, "req" => $request]);
    }
}
