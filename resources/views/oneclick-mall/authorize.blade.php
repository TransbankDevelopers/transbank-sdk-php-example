@php
    $navigation = ['auth' => 'Autorizar pago', 'other' => 'Consultas'];
@endphp

<x-layout active-link="Oneclick Mall" :navigation="$navigation">
    <h1 id="auth">Oneclick Mall - Autorizar pago</h1>
    <p class="mb-32">
        En este primer paso, procederemos a autorizar una transacción en la tarjeta que ha sido previamente inscrita.
    </p>

    <h2>Paso 1: Peticion</h2>
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

    <h2>Paso 2: Respuesta</h2>
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
        <form action={{ route('oneclick-mall.refund') }} method="POST">
            @csrf
            <div class="tbk-card">
                <div class="card-multi-field">
                    <div class="input-container">
                        <label for="buyOrder" class="tbk-label">Orden compra::</label>
                        <input type="text" name="buyOrder" class="tbk-input-text" value={{ $resp->buyOrder }}>
                    </div>
                    <div class="input-container">
                        <label for="childCommerceCode" class="tbk-label">Código de comercio:</label>
                        <input type="text" name="childCommerceCode" class="tbk-input-text"
                            value={{ $detail->commerceCode }}>
                    </div>
                    <div class="input-container">
                        <label for="childBuyOrder" class="tbk-label">Orden de compra (tienda hija):</label>
                        <input type="text" name="childBuyOrder" class="tbk-input-text" value={{ $detail->buyOrder }}>
                    </div>
                    <div class="input-container">
                        <label for="amount" class="tbk-label">Monto a reembolsar:</label>
                        <input type="text" name="amount" class="tbk-input-text" value={{ $detail->amount }}>
                    </div>
                </div>
                <div class="tbk-card-footer ">
                    <button class="tbk-button primary">REEMBOLSAR</button>
                </div>
            </div>
        </form>
    @endforeach
    <a href={{ route('oneclick-mall.status', ['buyOrder' => $resp->buyOrder]) }}
        class="tbk-button primary mb-32">CONSULTAR ESTADO</a>

</x-layout>
