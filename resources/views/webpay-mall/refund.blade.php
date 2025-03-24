@php
$navigation = ['request' => 'Petición', 'response' => 'Respuesta'];
@endphp

<x-layout active-link="Webpay Mall" :navigation="$navigation">
    <h1>Webpay Mall - Reembolsar</h1>
    <p class="mb-32">
        En esta etapa, tienes la opción de solicitar el reembolso del monto al titular de la tarjeta.
        Dependiendo del monto y el tiempo transcurrido desde la transacción, este proceso podría resultar en una Reversa o Anulación, dependiendo de ciertas condiciones (Reversa en las primeras 3 horas de la autorización, anulación posterior a eso), o una Anulación parcial si el monto es menor al total.
        Las anulaciones parciales para tarjetas débito y prepago no están soportadas.
    </p>

    <h2 id="request">Paso 1 - Petición:</h2>
    <p class="mb-32">
        Para llevar a cabo el reembolso, necesitas proporcionar el token de la transacción, el monto que
        quieres reversar, el código de comercio de la tienda hijo y el orden de compra del detalle de la transacción.
    </p>

    <p class="mb-32">
        Las transacciones de Webpay se pueden anular o reversar dadas algunas condiciones. Para cualquiera de éstas
        operaciones se utiliza el mismo servicio web que discernirá si se realizará una reversa o una anulación.

        Para poder ejecutar una reversa ésta debe ser realizada antes de las 3 horas de efectuada la confirmación por el
        monto total y en compras con tarjeta de crédito, débito o prepago.

        Una vez pasadas las tres horas, siempre se ejecutará una anulación.
    </p>

    <ul class="mb-32">
        <li>
            En transacciones con tarjeta de débito o prepago solo es posible anular por el monto total.
        </li>
        <li>
            En transacciones con tarjeta de crédito puedes anular por cualquier monto igual o menor al total de la
            compra.
        </li>
        <li>
            No se pueden hacer Anulaciones parciales de compras con cuotas.
        </li>
    </ul>

    <p class="mb-32">
        En <a href="https://www.transbankdevelopers.cl/producto/webpay#anulaciones-y-reversas" class="tbk-link">este link
        </a> podrás ver mayor información sobre las condiciones y casos para anular o reversar transacciones.
    </p>

    <x-snippet>
        $resp = $mallTransaction->refund($token, $buyOrder, $childCommerceCode,
        $amount);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p class="mb-32">Transbank responderá con el resultado del proceso de reembolso, indicando si se ha realizado una
        Reversa, Anulación o Anulación Parcial.
    </p>

    <x-snippet :content="$resp" />
</x-layout>
