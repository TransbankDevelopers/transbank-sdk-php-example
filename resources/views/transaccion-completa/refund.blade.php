@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta'];
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
            <a class="current-breadcrumb" href="/transaccion-completa/commit">Reversa</a>
        </div>

    </div>

    <h1>Transacción Completa - Reembolsar</h1>
    <p class="mb-32">En esta etapa, tendrás la posibilidad de solicitar el reembolso del dinero al tarjeta habiente. El
        tipo de reembolso (Reversa, Anulación o Anulación parcial) dependerá del monto y el tiempo transcurrido desde la
        transacción.</p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">Para efectuar la solicitud de reembolso, necesitarás el token de la transacción y el monto que
        deseas reversar. Si decides anular el monto total, puede resultar en una Reversa o Anulación, según ciertas
        condiciones. En caso de un monto menor al total, se realizará una Anulación parcial. Las anulaciones parciales
        para tarjetas débito y prepago no están soportadas.
    </p>
    <p class="mb-32">En este <a class="tbk-link"
            href="https://www.transbankdevelopers.cl/producto/webpay#anulaciones-y-reversas" target="_blanck">link</a>
        podrás ver mayor información sobre las condiciones y casos para anular o reversar
        transacciones.
    </p>
    <x-snippet>
        use Transbank\Webpay\TransaccionCompleta\Transaction;
        use Transbank\Webpay\Options;
        //configuración de la transacción
        $option = new Options(API_KEY, COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $transaction = new Transaction($option);
        $resp = $transaction->refund($token, $amount);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p>Transbank responderá con el resultado de la reversa o anulación. Evalúa cuidadosamente esta respuesta para
        confirmar que el reembolso se haya procesado de manera efectiva.</p>

    <x-snippet :content="$respond" />
    <a href="{{ route('transaccion-completa.status', ['token' => $request['token']]) }}"
        class="tbk-button primary mb-32">CONSULTAR ESTADO</a>

</x-layout>
