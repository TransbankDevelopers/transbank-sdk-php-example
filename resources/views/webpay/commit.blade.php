@php
    $navigation = ['data' => 'Datos recibidos', 'request' => 'Petición', 'response' => 'Respuesta', 'operations' => 'Operaciones'];
@endphp

<x-layout active-link="Webpay Plus" :navigation="$navigation">

    <h1>Webpay Plus - Confirmar transacción</h1>
    <p class="mb-32">En este paso es importante confirmar la transacción para notificar a Transbank que hemos recibido
        exitosamente los detalles de la transacción. <b>Es importante destacar que si la confirmación no se realiza, la
            transacción será caducada.</b>

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
        $resp = $transaction->commit($token);
    </x-snippet>

    <h2 id="response">Paso 3 - Respuesta:</h2>
    <p class="mb-32">
        Una vez que la transacción ha sido confirmada Transbank proporcionará la siguiente información.
        Es fundamental conservar esta respuesta y verificar que el campo "response_code" tenga un valor de cero y que el
        campo "status" sea "AUTHORIZED".
    </p>

    <x-snippet :content="$resp" />


    <h2>¡Listo!</h2>
    <p class="mb-32">
        Con la confirmación exitosa, ya puedes mostrar al usuario una página de éxito de la transacción,
        proporcionándole la tranquilidad de que el proceso ha sido completado con éxito.
    </p>
    <p id="operations">
        Después de confirmar la transacción, podrás realizar otras operaciones útiles:
    </p>
    <ul>
        <li>
            <span class="fw-700">Reembolsar:</span> Puedes reversar o anular el pago según ciertas condiciones
            comerciales.
        </li>
        <li>
            <span class="fw-700">Consultar Estado:</span> Hasta 7 días después de la transacción, podrás consultar el
            estado de la
            transacción.
        </li>
    </ul>

    <form action={{ route('webpay.refund') }} method="GET">
        @csrf
        <div class="tbk-refund-card mb-32">
            <div class="input-container">
                <label for="amount" class="tbk-label">Monto a reembolsar:</label>
                <input type="text" name="amount" class="tbk-input-text" value={{ $resp->amount }}>
                <input type="hidden" name="token" class="tbk-input-text" value={{ $token }}>
            </div>
            <div class="tbk-refund-button-container">
                <button class="tbk-button primary">REEMBOLSAR</button>
                <a href={{ route('webpay.status', ['token' => $token]) }} class="tbk-button primary">CONSULTAR ESTADO</a>
            </div>
        </div>
    </form>
</x-layout>
