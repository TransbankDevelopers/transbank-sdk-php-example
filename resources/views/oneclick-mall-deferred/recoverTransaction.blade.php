@php
    $navigation = ['recovery' => 'Inscripción anulada'];
@endphp

<x-layout active-link="Oneclick Mall Diferido" :navigation="$navigation">
    <h1 id="recovery">Oneclick Mall Diferido - Inscripción anulada</h1>
    <p class="mb-32">
        El pago de la inscripción ha sido anulado por el usuario. En esta etapa, después de abandonar el formulario de
        pago, no es necesario realizar la confirmación. Aquí te proporcionamos información esencial sobre el estado de
        la transacción anulada:
    </p>

    <h2>Datos Recibidos:</h2>
    <p class="mb-32">
        Para evitar posibles problemas, recomendamos reiniciar la transacción y completar el proceso de pago en una
        sesión activa y continua.
    </p>

    <x-snippet :content="$req" />

</x-layout>
