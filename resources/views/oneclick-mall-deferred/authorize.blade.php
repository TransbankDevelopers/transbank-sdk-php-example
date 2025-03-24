@php
$navigation = ['request' => 'Petición', 'response' => 'Respuesta', 'other' => 'Otras utilidades'];
@endphp

<x-layout active-link="Oneclick Mall Diferido" :navigation="$navigation">
    <h1>Oneclick Mall Diferido - Autorizar pago</h1>
    <p class="mb-32">
        En este primer paso, procederemos a autorizar una transacción en la tarjeta que ha sido previamente inscrita.
    </p>

    <h2 id="request">Paso 1: Peticion</h2>
    <p class="mb-32">
        Ahora que contamos con el "username" y el "tbk_user" obtenidos durante la inscripción, estamos listos para
        autorizar transacciones en la tarjeta inscrita.
    </p>
    <x-snippet>
        $details = [
        -[
        ---"child_commerce_code",
        ---"child_buy_order",
        ---"amount",
        ---"installments_number"
        -],
        -[
        ---"child_commerce_code2",
        ---"child_buy_order2",
        ---"amount",
        ---"installments_number",
        -]
        ];

        $resp = $mallTransaction->authorize($userName, $tbkUser, $buyOrder, $details);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p class="mb-32">
        Una vez que la transacción ha sido autorizada, recibirás los siguientes datos de respuesta:
    </p>

    <x-snippet :content="$resp" />

    <h2>¡Listo!</h2>
    <p class="mb-32">
        Con la autorización exitosa, puedes mostrar al usuario una página de éxito de la transacción, proporcionándole
        la confirmación de que el proceso se ha completado con éxito.
    </p>

    <h2 id="other">Otras utilidades</h2>
    <p class="mb-32">Con la inscripción exitosa se pueden autorizar transacciones.</p>

    <h2>Autorizar una transacción</h2>
    <p class="mb-32">
        Después de autorizar la transacción, considera las siguientes utilidades adicionales:
    </p>
    <ul>
        <li>
            <span class="fw-700">Reembolsar:</span> Puedes reversar o anular el pago según ciertas condiciones
            comerciales.
        </li>
        <li>
            <span class="fw-700">Consultar Estado:</span> Hasta 7 días después de la transacción, podrás consultar el
            estado de la transacción.
        </li>
    </ul>

    @foreach ($resp->details as $detail)
    <form action={{ route('oneclick-mall-deferred.capture') }} method="POST">
        @csrf
        <div class="tbk-card">
            <div class="card-multi-field">
                <div class="input-container">
                    <label for="childcommerceCode" class="tbk-label">Codigo de comercio (tienda hija):</label>
                    <input type="number" name="childCommerceCode" class="tbk-input-text"
                        value={{ $detail->commerceCode }}>
                </div>
                <div class="input-container">
                    <label for="childBuyOrder" class="tbk-label">Orden de compra (tienda hija):</label>
                    <input type="text" name="childBuyOrder" class="tbk-input-text" value={{ $detail->buyOrder }}>
                </div>
                <div class="input-container">
                    <label for="authorizationCode" class="tbk-label">Código de autorización (tienda hija):</label>
                    <input type="text" name="authorizationCode" class="tbk-input-text"
                        value={{ $detail->authorizationCode }}>
                </div>
                <div class="input-container">
                    <label for="amount" class="tbk-label">Monto a reembolsar:</label>
                    <input type="number" name="amount" class="tbk-input-text" value={{ $detail->amount }}>
                </div>
            </div>
            <div class="tbk-card-footer ">
                <button class="tbk-button primary">Capturar</button>
            </div>
        </div>
    </form>
    @endforeach

</x-layout>
