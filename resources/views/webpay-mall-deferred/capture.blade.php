@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta', 'operations' => 'Otras operaciones'];
@endphp

<x-layout active-link="Webpay Mall Diferido" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">

            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/webpay-mall-diferido/create">Webpay Mall Diferido</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/webpay-mall-diferido/capture">capturar transacción</a>
        </div>
    </div>
    <h1>Webpay Mall diferido - capturar transacción</h1>
    <p class="mb-32">
        En este paso debemos capturar la transacción para hacer efectiva la reserva de dinero realizada
        previamente en la etapa de autorización.
    </p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">
        Para capturar una transacción necesitaremos el Token, Orden de compra, Código de autorización y monto a
        capturar. Se hace de la siguiente manera.
    </p>
    <x-snippet>
        $resp = $mallTransaction->capture($childCommerceCode $token, $buyOrder, $authorizationCode, $amount);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p class="mb-32">
        Transbank contestará con lo siguiente. Debes guardar esta información, lo único que debes validar
        es que response_code sea igual a cero.
    </p>

    <x-snippet :content="$resp" />

    <h2 id="operations">Otras utilidades</h2>

    <p class="mb-32">
        Luego de capturada la transacción puedes Reembolsar (reversar o anular) el pago dependiendo de
        ciertas condiciones comerciales. También puedes consultar el estado de la transacción hasta 7 días después de
        realizada.
    </p>

    <form action={{ route('webpay-mall-deferred.refund') }} method="GET">
        @csrf
        <div class="tbk-refund-card  mb-32">
            <div class="input-container">
                <label for="amount" class="tbk-label">Monto a reembolsar:</label>
                <input type="text" name="amount" class="tbk-input-text" value={{ $resp->capturedAmount }}>
                <input type="hidden" name="childCommerceCode" class="tbk-input-text"
                    value={{ $request['childCommerceCode'] }}>
                <input type="hidden" name="buyOrder" class="tbk-input-text" value={{ $request['buyOrder'] }}>
                <input type="hidden" name="token" class="tbk-input-text" value={{ $request['token'] }}>
            </div>
            <div class="tbk-refund-button-container">
                <button class="tbk-button primary">REEMBOLSAR</button>
                <a href={{ route('webpay-mall-deferred.status', ['token' => $request['token']]) }}
                    class="tbk-button primary">CONSULTAR
                    ESTADO</a>
            </div>
        </div>
    </form>

</x-layout>
