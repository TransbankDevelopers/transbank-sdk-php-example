<?php

namespace App\Http\Controllers;

use Throwable;
use Transbank\Webpay\Exceptions\WebpayException;

abstract class Controller
{
    protected function renderErrorPage(Throwable $exception)
    {
        return view('error-page', [
            'error' => $this->getDisplayableErrorMessage($exception),
        ]);
    }

    protected function getDisplayableErrorMessage(Throwable $exception): string
    {
        $current = $exception;

        while ($current !== null) {
            if ($current instanceof WebpayException) {
                return $current->getMessage();
            }

            $current = $current->getPrevious();
        }

        return 'Ocurrió un error inesperado al procesar la operación.';
    }
}
