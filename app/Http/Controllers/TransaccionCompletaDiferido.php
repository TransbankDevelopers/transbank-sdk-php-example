<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\TransaccionCompleta\Transaction;
use Transbank\Webpay\Options;



class TransaccionCompletaDiferido extends Controller
{
    private Transaction $transaction;
    const PRODUCT = 'Transaccion Completa Diferido';

    public function __construct()
    {
        $apiKey = config('app.transbank.webpay_api_key');
        $commerceCode = config('app.transbank.tx_deferred_commerce_code');
        $option = new Options($apiKey, $commerceCode, Options::ENVIRONMENT_INTEGRATION);
        $this->transaction = new Transaction($option);
    }

    public function index()
    {
        return view('transaccion-completa-diferido.index');
    }

    public function create(Request $request)
    {

        try {
            $req = $request->except('_token');
            $cardNumberClean = str_replace(' ', '', $req['number']);
            $parts = explode('/', $req['expiry']);
            $month = $parts[0];
            $year = $parts[1];
            $cardExpiryFormatted = $year . '/' . $month;
            $createTx = [
                'buyOrder' => "O-" . random_int(1, 10000),
                "sessionId" => "S-" . random_int(1, 10000),
                'amount' => random_int(1000, 2000)
            ];


            $resp = $this->transaction->create(
                $createTx['buyOrder'],
                $createTx['sessionId'],
                $createTx['amount'],
                $cardNumberClean,
                $cardExpiryFormatted,
                $req['cvc']
            );

            session(['transaccion_completa_df_amount' => $createTx['amount']]);

            return view('transaccion-completa-diferido.create', ["request" => $createTx, "respond" => $resp]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function commit(Request $request)
    {
        try {
            $req = $request->except('_token');

            $resp = $this->transaction->commit(
                $req['token'],
                idQueryInstallments: $req['idQueryInstallments'] ?? null
            );

            return view('transaccion-completa-diferido.commit', [
                "request" => $req,
                "respond" => $resp,
                "amount" => session('transaccion_completa_df_amount')
            ]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function installments(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->installments($req['token'], $req['installments_number']);


            return view('transaccion-completa-diferido.installments', ["request" => $req, "respond" => $resp]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }
    public function status(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->status($req['token']);

            return view('transaccion-completa-diferido.status', ["request" => $req, "respond" => $resp]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }

    public function refund(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->refund($req['token'], $req['amount']);

            return view('transaccion-completa-diferido.refund', [
                "request" => $req,
                "respond" => $resp
            ]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }
    public function capture(Request $request)
    {
        try {
            $req = $request->except('_token');
            $resp = $this->transaction->capture($req['token'], $req['buyOrder'], $req['authorizationCode'], $req['amount']);

            return view('transaccion-completa-diferido.capture', [
                "request" => $req,
                "respond" => $resp,
                "amount" => session('transaccion_completa_df_amount')
            ]);
        } catch (\Exception $e) {
            return view('error-page', ["error" => $e->getMessage()]);
        }
    }
}
