@php
    $navigation = ['confirm' => 'Confirmar transacción', 'other' => 'Otras operaciones'];
@endphp

<x-layout active-link="Webpay Mall Diferido" :navigation="$navigation">

    <h1 id="confirm">Webpay Mall diferido - capturar transacción</h1>
    <p class="mb-32"> En este paso debemos capturar la transacción para realmente capturar el dinero que habia sido
        previamente
        reservado al hacer la transacción
    </p>

    <h2>Paso 1: Petición</h2>
    <p class="mb-32">
        Para capturar una transacción necesitaremos el Token, Orden de compra, Código de autorización y monto a
        capturar. Se hace de la siguiente manera.
    </p>
    <x-snippet>
        $resp = $mallTransaction->capture($childCommerceCode $token, $buyOrder, $authorizationCode, $amount);
    </x-snippet>

    <h2>Paso 2: Respuesta</h2>
    <p class="mb-32">
        Transbank contestará con lo siguiente. Debes guardar esta información, lo único que debes validar
        es que response_code sea igual a cero.
    </p>

    <x-snippet :content="$resp" />

    <h2 id="other">Otras utilidades</h2>

    <p class="mb-32">
        Luego de capturada la transacción puedes Reembolsar (reversar o anular) el pago dependiendo de
        ciertas condiciones comerciales. También puedes consultar el estado de la transacción hasta 7 días después de
        realizada.
    </p>

    <form action={{ route('webpay-mall-deferred.refund') }} method="POST">
        @csrf
        <div class="tbk-card">
            <div class="input-container">
                <label for="amount" class="tbk-label">Monto a reembolsar:</label>
                <input type="text" name="amount" class="tbk-input-text" value={{ $resp->capturedAmount }}>
                <input type="hidden" name="childComerceCode" class="tbk-input-text"
                    value={{ $request['childComerceCode'] }}>
                <input type="hidden" name="buyOrder" class="tbk-input-text" value={{ $request['buyOrder'] }}>
                <input type="hidden" name="token" class="tbk-input-text" value={{ $request['token'] }}>
            </div>
            <div class="tbk-card-footer ">
                <button class="tbk-button primary">REEMBOLSAR</button>
            </div>
        </div>
    </form>

    <a href={{ route('webpay-mall-deferred.status', ['token' => $request['token']]) }}
        class="tbk-button primary mb-32">CONSULTAR
        ESTADO</a>
</x-layout>
