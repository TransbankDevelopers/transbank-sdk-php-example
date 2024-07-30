@php
    $navigation = ['refund' => 'Reembolsar'];
@endphp

<x-layout active-link="Webpay Mall" :navigation="$navigation">
    <h1 id="refund">Webpay Plus - Reembolsar</h1>
    <p class="mb-32">En esta etapa, tienes la opción de solicitar el reembolso del monto al titular de la tarjeta.
        Dependiendo del monto y el tiempo transcurrido desde la transacción, este proceso podría resultar en una
        Reversa, Anulación o Anulación Parcial.

    </p>

    <h2>Paso 1 - Petición:</h2>
    <p class="mb-32">
        Para llevar a cabo el reembolso, necesitas proporcionar el token de la transacción, el monto que
        quieres reversar, el código de comercio de la tienda hijo y el orden de compra del detalle de la transacción. Si
        anulas el monto total, podría ser una Reversa o Anulación, dependiendo de ciertas condiciones, o una Anulación
        Parcial si el monto es menor al total.
    </p>

    <p>Algunas consideraciones a tener en cuenta</p>
    <ul class="mb-32">
        <li>
            No es posible realizar Anulaciones ni Anulaciones Parciales en tarjetas que no sean de crédito.
        </li>
        <li>
            No es posible realizar Anulaciones Parciales en pagos con cuotas.
        </li>
        <li>No se admiten reembolsos de compras en cuotas.</li>
    </ul>

    <p>En <a href="https://www.transbankdevelopers.cl/producto/webpay#anulaciones-y-reversas" class="tbk-link">este link
        </a> podrás ver
        mayor información sobre las condiciones y casos para anular o reversar transacciones.</p>
    <x-snippet>
        $resp = $mallTransaction->refund($token, $buyOrder, $childComerceCode,
        $amount);
    </x-snippet>

    <h2>Paso 2: Respuesta</h2>
    <p class="mb-32">Transbank responderá con el resultado del proceso de reembolso, indicando si se ha realizado una
        Reversa, Anulación o Anulación Parcial.
    </p>

    <x-snippet :content="$resp" />
</x-layout>
