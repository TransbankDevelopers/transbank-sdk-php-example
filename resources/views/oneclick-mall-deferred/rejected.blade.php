@php
    $navigation = ['rejected' => 'Rechazo Bancario', 'example' => 'Ejemplo'];
@endphp

<x-layout active-link="Oneclick Mall Diferido" :navigation="$navigation">
    <h1 id="rejected">Oneclick Mall Diferido- Rechazo Bancario</h1>
    <p class="mb-32">
        En esta fase, pueden surgir inconvenientes, ya sea con el titular de la tarjeta o a nivel bancario, lo que
        resulta en el estado final de la transacción siendo marcado como "FAILED".
    </p>

    <h2>Paso 1: Datos recibidos</h2>
    <p class="mb-32">
        Después de finalizar el flujo en el formulario de inscripción, recibirás un GET con la siguiente información:
    </p>
    <x-snippet :content="$token" />

    <h2>Paso 2: Petición de autorización</h2>
    <p class="mb-32">
        Utiliza el token recibido para finalizar la Inscripción mediante una nueva llamada a Oneclick.
    </p>

    <x-snippet>
        $resp = $mallInscription->finish($token);
    </x-snippet>

    <h2>Paso 3: Respuesta</h2>
    <p class="mb-32">
        Transbank responderá con la siguiente información.
    </p>

    <x-snippet :content="$resp" />


    <p class="mb-32">En este caso la inscripción fue rechazada, tendrás que repetir el proceso</p>

</x-layout>
