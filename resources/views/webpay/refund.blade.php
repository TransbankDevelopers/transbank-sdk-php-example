@php
    $navigation = ['refund' => 'Reembolsar'];
@endphp

<x-layout active-link="Wepbay Plus" :navigation="$navigation">

    <h1 id="refund">Webpay Plus - Reembolsar</h1>
    <p class="mb-32">En esta etapa, tienes la opción de solicitar el reembolso del monto al titular de la tarjeta.
        Dependiendo del monto y el tiempo transcurrido desde la transacción, este proceso podría resultar en una
        Reversa, Anulación o Anulación Parcial.
    </p>

    <h2>Paso 1 - Petición:</h2>
    <p class="mb-32">Para llevar a cabo el reembolso, necesitas proporcionar el token de la transacción y el monto que
        deseas
        reversar. Si anulas el monto total, podría ser una Reversa o Anulación, dependiendo de ciertas condiciones, o
        una Anulación Parcial si el monto es menor al total.
    </p>

    <span>Condiciones Importantes:</span>
    <ul>
        <li>
            No es posible realizar Anulaciones ni Anulaciones Parciales en tarjetas que no sean de crédito.
        </li>
        <li>No se admiten reembolsos de compras en cuotas.</li>
    </ul>

    <div class="mb-32"> snippet</div>

    <h2>Paso 2: Respuesta</h2>
    <p class="mb-32">Transbank responderá con el resultado del proceso de reembolso, indicando si se ha realizado una
        Reversa, Anulación o Anulación Parcial.
    </p>

    <div class="mb-32">
        @dump($resp)
    </div>


</x-layout>
