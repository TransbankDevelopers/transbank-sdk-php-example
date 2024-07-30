@php
    $navigation = ['create' => 'Crear transacción', 'example' => 'Ejemplo'];
@endphp

<x-layout active-link="Webpay Plus Diferido" :navigation="$navigation">
    <h1 id="create">Webpay Plus Diferido - Creación de transacción</h1>
    <p class="mb-32">
        En este paso debemos capturar la transacción para realmente capturar el dinero que habia sido previamente
        reservado al hacer la transacción
    </p>

    <h2>Paso 1: Petición</h2>
    <p class="mb-32">
        Para capturar una transacción necesitaremos el Token, Orden de compra, Código de autorización y monto a
        capturar. Se hace de la siguiente manera.
    </p>
    <x-snippet>
        $resp = $transaction->capture($token, $buyOrder, $authorizationCode, $amount);
    </x-snippet>

    <h2>Paso 2: Respuesta</h2>
    <p class="mb-32">
        Transbank contestará con lo siguiente. Debes guardar esta información, lo único que debes validar
        es que response_code sea igual a cero.
    </p>

    <x-snippet :content="$resp" />

    <h2 id="example">
        Otras utilidades
    </h2>
    <p class="mb-32">
        Luego de capturada la transacción puedes Reembolsar (reversar o anular) el pago dependiendo de
        ciertas condiciones comerciales. También puedes consultar el estado de la transacción hasta 7 días después de
        realizada.
    </p>

    <p class="mb-32">
        Por último, con la respuesta del servicio que confirma la creación de la transacción, procedemos
        a crear el formulario de pago. Para fines de este ejemplo, haremos visible el campo "token_ws", el cual es
        esencial para completar el proceso de pago de manera exitosa.
    </p>

    <form action={{ route('webpay-deferred.refund') }} method="POST">
        @csrf
        <div class="tbk-card">
            <div class="input-container">
                <label for="amount" class="tbk-label">Monto a Reembolsar:</label>
                <input type="text" name="amount" class="tbk-input-text" value={{ $resp->capturedAmount }}>
                <input type="hidden" name="token" class="tbk-input-text" value={{ $token }}>
            </div>
            <div class="tbk-card-footer ">
                <button class="tbk-button primary">REEMBOLSAR</button>
            </div>
        </div>
    </form>
    <a href={{ route('webpay-deferred.status', ['token' => $token]) }} class="tbk-button primary mb-32">CONSULTAR
        ESTADO</a>
</x-layout>
