@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta'];
@endphp

<x-layout active-link="Transacción Completa Mall" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/transaccion-completa-mall">Webpay Transacción Completa Mall</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/transaccion-completa-mall/refund">Reembolsar</a>
        </div>
    </div>

    <h1>Transacción Completa Mall - Reembolsar</h1>
    <p class="mb-32">En esta etapa, tendrás la posibilidad de solicitar el reembolso del dinero al tarjeta habiente. El
        tipo de reembolso (Reversa, Anulación o Anulación parcial) dependerá del monto y el tiempo transcurrido desde la
        transacción.</p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">Necesitas el token de la transacción, el buy_order del hijo, el commerce_code hijo y el monto que
        deseas reversar. Si decides anular el monto total, puede resultar en una Reversa o Anulación según ciertas
        condiciones. En caso de un monto menor al total, se realizará una Anulación parcial. Las anulaciones parciales
        para tarjetas débito y prepago no están soportadas.
    </p>
    <p class="mb-32">En este <a class="tbk-link"
            href="https://www.transbankdevelopers.cl/producto/webpay#anulaciones-y-reversas" target="_blanck">link</a>
        podrás ver mayor información sobre las condiciones y casos para anular o reversar
        transacciones.
    </p>
    <x-snippet>
        use Transbank\Webpay\TransaccionCompleta\MallTransaction;
        use Transbank\Webpay\Options;
        //configuración de la transacción
        $option = new Options(API_KEY, COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $transaction = new MallTransaction($option);
        $resp = $transaction->refund($token, $buyOrder, $commerceCodeChild, $amount);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p>Transbank responderá con el resultado de la reversa o anulación. Evalúa cuidadosamente esta respuesta para
        confirmar que el reembolso se haya procesado de manera efectiva.</p>

    <x-snippet :content="$respond" />
    <a href="{{ route('transaccion-completa-mall.status', ['token' => $request['token']]) }}"
        class="tbk-button primary mb-32">CONSULTAR ESTADO</a>

</x-layout>
