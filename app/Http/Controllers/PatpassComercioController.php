<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\PatpassComercio\Inscription;
use Transbank\PatpassComercio\Options;
use Transbank\PatpassComercio\PatpassComercio;

class PatpassComercioController extends Controller
{
    private Inscription $inscription;

    public function __construct()
    {
        $options = new Options(
            PatpassComercio::INTEGRATION_API_KEY,
            PatpassComercio::INTEGRATION_COMMERCE_CODE,
            Options::ENVIRONMENT_INTEGRATION
        );
        $this->inscription = new Inscription($options);
    }

    public function start()
    {
        try {
            $startTx = [
                'serviceId' => 'Service-' . random_int(1, 10000),
                'maxAmount' => 100,
                'returnUrl' => url('/patpass-comercio/commit'),
                'finalUrl' => url('/patpass-comercio/voucher'),
            ];

            $patpassData = [
                'name' => 'Isaac',
                'lastName' => 'Newton',
                'secondLastName' => 'Gonzales',
                'rut' => '11111111-1',
                'phone' => '123456734',
                'cellPhone' => '123456723',
                'patpassName' => 'Membresia de cable',
                'personEmail' => 'developer@continuum.cl',
                'commerceEmail' => 'developer@continuum.cl',
                'address' => 'Satelite 101',
                'city' => 'Santiago',
            ];

            $resp = $this->inscription->start(
                $startTx['returnUrl'],
                $patpassData['name'],
                $patpassData['lastName'],
                $patpassData['secondLastName'],
                $patpassData['rut'],
                $startTx['serviceId'],
                $startTx['finalUrl'],
                (string) $startTx['maxAmount'],
                $patpassData['phone'],
                $patpassData['cellPhone'],
                $patpassData['patpassName'],
                $patpassData['personEmail'],
                $patpassData['commerceEmail'],
                $patpassData['address'],
                $patpassData['city']
            );

            $requestData = array_merge($startTx, $patpassData);

            return view('patpass-comercio.start', [
                'request' => $requestData,
                'resp' => $resp,
            ]);
        } catch (\Exception $e) {
            return view('error-page', ['error' => $e->getMessage()]);
        }
    }

    public function commit(Request $request)
    {
        $response = null;
        try {
            $jToken = $request->input('j_token')
                ?? $request->input('J_TOKEN')
                ?? $request->input('token')
                ?? session('patpass_j_token');

            if ($request->isMethod('post')) {
                if ($jToken) {
                    session(['patpass_j_token' => $jToken]);
                    $response = redirect()->route('patpass.commit');
                } else {
                    $response = $this->renderPatpassError('No se recibió el token de inscripción (J_TOKEN).');
                }
            } else {
                if (!$jToken) {
                    $response = $this->renderPatpassError('No se encontró el token de inscripción (J_TOKEN).');
                } else {
                    $resp = $this->inscription->status($jToken);

                    $responsePayload = [
                        'authorized' => $resp->status,
                        'voucherUrl' => $resp->urlVoucher,
                    ];

                    $response = view('patpass-comercio.commit', [
                        'j_token' => $jToken,
                        'resp' => $resp,
                        'responsePayload' => $responsePayload,
                    ]);
                }
            }
        } catch (\Exception $e) {
            return view('error-page', ['error' => $e->getMessage()]);
        }

        return $response;
    }

    public function voucher(Request $request)
    {
        $response = null;
        try {
            $jToken = $request->input('j_token')
                ?? $request->input('J_TOKEN')
                ?? $request->input('tokenComercio')
                ?? $request->input('token')
                ?? session('patpass_j_token');

            if ($request->isMethod('post')) {
                if ($jToken) {
                    session(['patpass_j_token' => $jToken]);
                    $response = redirect()->route('patpass.voucher');
                } else {
                    $response = $this->renderPatpassError('No se recibió el token de inscripción (J_TOKEN).');
                }
            } else {
                if (!$jToken) {
                    $response = $this->renderPatpassError('No se encontró el token de inscripción (J_TOKEN).');
                } else {
                    $response = view('patpass-comercio.voucher', [
                        'j_token' => $jToken,
                    ]);
                }
            }
        } catch (\Exception $e) {
            return view('error-page', ['error' => $e->getMessage()]);
        }

        return $response;
    }

    private function renderPatpassError(string $message)
    {
        return view('error-page', ['error' => $message]);
    }
}
