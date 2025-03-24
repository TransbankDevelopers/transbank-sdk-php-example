@php
$navigation = ['data' => 'Datos recibidos', 'request' => 'Petición', 'response' => 'Respuesta', 'operations' => 'Operaciones'];
@endphp

<x-layout active-link="Webpay Mall Diferido" :navigation="$navigation">

    <h1>Webpay Mall diferido - Confirmar transacción</h1>
    <p class="mb-32">En este paso es importante confirmar la transacción para notificar a Transbank que hemos recibido
        exitosamente los detalles de la transacción. <b>Es importante destacar que si la confirmación no se realiza, la transacción será caducada.</b>
    </p>

    <h2 id="data">Paso 1 - Datos recibidos:</h2>
    <ul class="mb-32">
        <p class="m-32">
            Después de completar el flujo en el formulario de pago, recibirás un GET con la siguiente
            información:
        </p>
    </ul>
    <x-snippet>(returnUrl)?token_ws={{ $token }} </x-snippet>

    <h2 id="request">Paso 2 - Petición:</h2>
    <p class="mb-32">
        Utilizarás el token recibido para confirmar la transacción mediante el SDK.
    </p>

    <x-snippet>
        $resp = $mallTransaction->commit($token);
    </x-snippet>

    <h2 id="response">Paso 3 - Respuesta:</h2>
    <p class="mb-32">
        Una vez que la transacción ha sido confirmada Transbank proporcionará la siguiente información.
        Es fundamental conservar esta respuesta y verificar que el campo "response_code" tenga un valor de cero y que el campo "status" sea "AUTHORIZED".
    </p>

    <x-snippet :content="$resp" />


    <h2 id="operations">¡Listo!</h2>
    <p class="mb-32">
        Es importante tener en cuenta que la transacción aún no ha sido capturada, por lo que hay que dejarle saber al
        tarjetahabiente que necesita un paso más; solo se ha retenido el saldo en su tarjeta. Después de confirmar la
        transacción, puedes:
    </p>

    <ul class="mb-32">
        <li>
            Capturar la transacción.
        </li>
        <li>
            Revertir la transacción si es necesario.
        </li>
        <li>
            Consultar el estado de la transacción hasta 7 días después de realizada.
        </li>
    </ul>

    <p class="mb-32">
        Capturar la transacción para realmente capturar el dinero que habia sido previamente
        reservado.
    </p>

    @foreach ($resp->details as $detail)
    <form action={{ route('webpay-mall-deferred.capture') }} method="POST">
        @csrf
        <div class="tbk-card">
            <div class="input-container">
                <label for="amount" class="tbk-label">Monto a capturar:</label>
                <input type="text" name="amount" class="tbk-input-text" value={{ $detail->amount }}>
                <input type="hidden" name="childCommerceCode" class="tbk-input-text"
                    value={{ $detail->commerceCode }}>
                <input type="hidden" name="authorizationCode" class="tbk-input-text"
                    value={{ $detail->authorizationCode }}>

                <input type="hidden" name="buyOrder" class="tbk-input-text" value={{ $detail->buyOrder }}>
                <input type="hidden" name="token" class="tbk-input-text" value={{ $token }}>
            </div>
            <div class="tbk-card-footer ">
                <button class="tbk-button primary">Capturar</button>
            </div>
        </div>
    </form>
    @endforeach
    <a href={{ route('webpay-mall-deferred.status', ['token' => $token]) }} class="tbk-button primary mb-32">
        CONSULTAR ESTADO
    </a>
</x-layout>
