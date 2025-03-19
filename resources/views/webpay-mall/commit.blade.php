@php
$navigation = ['confirm' => 'Confirmar transacción', 'other' => 'Otras operaciones'];
@endphp

<x-layout active-link="Webpay Mall" :navigation="$navigation">

    <h1 id="confirm">Webpay Mall - Confirmar transacción</h1>
    <p class="mb-32">En este paso es importante confirmar la transacción para notificar a Transbank que hemos recibido
        exitosamente los detalles de la transacción. <b>Es importante destacar que si la confirmación no se realiza, la transacción será caducada.</b>
    </p>

    <h2>Paso 1 - Datos recibidos:</h2>
    <ul class="mb-32">
        <p class="m-32">
            Después de completar el flujo en el formulario de pago, recibirás un GET con la siguiente
            información:
        </p>
    </ul>
    <x-snippet>(returnUrl)?token_ws={{ $token }} </x-snippet>

    <h2>Paso 2 - Petición:</h2>
    <p class="mb-32">
        Utilizarás el token recibido para confirmar la transacción mediante el SDK.
    </p>

    <x-snippet>
        $resp = $transaction->commit($token);
    </x-snippet>

    <h2>Paso 3 - Respuesta:</h2>
    <p class="mb-32">
        Una vez que la transacción ha sido confirmada Transbank proporcionará la siguiente información.
        Es fundamental conservar esta respuesta y verificar que el campo "response_code" tenga un valor de cero y que el campo "status" sea "AUTHORIZED".
    </p>

    <x-snippet :content="$resp" />


    <h2>¡Listo!</h2>
    <p class="mb-32">
        Con la confirmación exitosa, ya puedes mostrar al usuario una página de éxito de la transacción,
        proporcionándole la tranquilidad de que el proceso ha sido completado con éxito.
    </p>
    <p>
        Después de confirmar la transacción, podrás realizar otras operaciones útiles:
    </p>
    <ul id="other">
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

    @foreach ($resp->details as $detail)
    <form action={{ route('webpay-mall.refund') }} method="POST">
        @csrf
        <div class="tbk-card">
            <div class="input-container">
                <label for="amount" class="tbk-label">Monto a reembolsar:</label>
                <input type="text" name="amount" class="tbk-input-text" value={{ $detail->amount }}>
                <input type="hidden" name="childCommerceCode" class="tbk-input-text"
                    value={{ $detail->commerceCode }}>
                <input type="hidden" name="buyOrder" class="tbk-input-text" value={{ $detail->buyOrder }}>
                <input type="hidden" name="token" class="tbk-input-text" value={{ $token }}>
            </div>
            <div class="tbk-card-footer ">
                <button class="tbk-button primary">REEMBOLSAR</button>
            </div>
        </div>
    </form>
    @endforeach
    <a href={{ route('webpay-mall.status', ['token' => $token]) }} class="tbk-button primary mb-32">CONSULTAR ESTADO</a>
</x-layout>
