@php
    $navigation = ['refund' => 'Reembolsar'];
@endphp

<x-layout active-link="Oneclick Mall" :navigation="$navigation">

    <h1 id="refund">Oneclick Mall - Reembolsar</h1>
    <p class="mb-32">En esta etapa, tienes la opción de solicitar el reembolso del monto al titular de la tarjeta.
        Dependiendo del monto y el tiempo transcurrido desde la transacción, este proceso podría resultar en una
        Reversa, Anulación o Anulación Parcial.
    </p>

    <h2>Paso 1 - Petición:</h2>
    <p class="mb-16">
        Para realizar el reembolso, necesitarás la siguiente información:
    </p>

    <ul class="mb-32">
        <li>Orden de compra de la transacción.</li>
        <li>Monto que deseas reversar.</li>
        <li>Código de comercio de la tienda hijo.</li>
        <li>Orden de compra del detalle de la transacción.</li>
    </ul>

    <p class="mb-32">
        Ten en cuenta que si anulas el monto total, puede ser una Reversa o Anulación, dependiendo de ciertas
        condiciones, o una Anulación parcial si el monto es menor al total. No es posible realizar Anulaciones ni
        Anulaciones parciales en tarjetas que no sean de crédito. Tampoco es posible realizar reembolsos de compras en
        cuotas.
    </p>

    <x-snippet>
        $resp = $mallTransaction->refund($buyOrder, $childCommerceCode, $childBuyOrder, $amount);
    </x-snippet>

    <p class="mb-32">Paso 2 - Respuesta:</p>
    <p class="mb-32">
        Transbank responderá con el resultado de la reversa o anulación. Analiza esta respuesta para confirmar que el
        reembolso se ha procesado correctamente.
    </p>

    <x-snippet :content="$resp" />

</x-layout>
