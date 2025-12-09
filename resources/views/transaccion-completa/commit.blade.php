@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta', 'form' => 'Formulario'];
@endphp

<x-layout active-link="Transacción Completa" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/transaccion-completa">Webpay Transacción Completa</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/transaccion-completa/commit">Confirmar</a>
        </div>

    </div>

    <h1>Transacción Completa - Confirmar transacción</h1>
    <p class="mb-32">En este paso crucial, procederemos a confirmar la transacción con el objetivo de notificar a
        Transbank que hemos recibido la transacción de manera exitosa. Es fundamental destacar que si no se confirma la
        transacción, esta será caducada.</p>

    <h2 id="request">Paso 1: Datos recibidos</h2>
    <p class="mb-32">Para confirmar la transacción, debes enviar el token correspondiente. En el caso de pagos a
        plazos, también debes incluir el ID de la consulta de cuotas. En algunos casos, será necesario proporcionar el
        índice del periodo diferido y un valor boolean indicando si se tomará el periodo de gracia.
    </p>
    <x-snippet>
        use Transbank\Webpay\TransaccionCompleta\Transaction;
        use Transbank\Webpay\Options;
        //configuración de la transacción
        $option = new Options(API_KEY, COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $transaction = new Transaction($option);
        $response = $resp = $transaction->commit($token, $idQueryInstallments, $deferredPeriodIndex, $gracePeriod);
    </x-snippet>

    <h2 id="response">Paso 2: Petición</h2>
    <p>Una vez que la transacción ha sido confirmada Transbank proporcionará la siguiente información. Es fundamental
        conservar esta respuesta y verificar que el campo "response_code" tenga un valor de cero y que el campo "status"
        sea "AUTHORIZED".</p>

    <x-snippet :content="$respond" />

    <h2 id="form">¡Listo!</h2>
    <p class="mb-16">Con la transacción confirmada, puedes mostrar al usuario una página de éxito de la transacción,
        proporcionándole la confirmación de que el proceso se ha completado con éxito.</p>

    <p>Después de confirmar la transacción, podrás realizar otras operaciones útiles:</p>
    <ul>
        <li><span class="fw-700">Reembolsar:</span> Puedes reversar o anular el pago según ciertas condiciones
            comerciales.</li>
        <li><span class="fw-700">Consultar Estado:</span> Hasta 7 días después de realizada la transacción, podrás
            consultar el estado de la transacción.</li>
    </ul>

    <form action="{{ route('transaccion-completa.refund') }}" method="GET">
        <div class="tbk-card">
            <div class="input-container mb-32">
                <label for="amount" class="tbk-label">Monto a reembolsar</label>
                <input type="text" id="amount" name="amount" class="tbk-input-text" value="{{ $amount }}">
                <input type="hidden" name="token" value="{{ $request['token'] }}">
            </div>

            <div class="tbk-card-footer">
                <button type="submit" class="tbk-button primary">REFUND</button>
            </div>
        </div>
    </form>

    <a href="{{ route('transaccion-completa.status', ['token' => $request['token']]) }}"
        class="tbk-button primary mb-32">STATUS</a>

</x-layout>
