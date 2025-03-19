@php
    $navigation = ['state' => 'Consultar estado'];
@endphp

<x-layout active-link="Oneclick Mall" :navigation="$navigation">

    <h1 id="state">Oneclick Mall - Consultar estado de transacción</h1>
    <p class="mb-32">Puedes solicitar el estado de una transacción hasta 7 días después de su realización. No hay límite
        de solicitudes de este tipo durante ese período. Sin embargo, una vez pasados los 7 días, ya no podrás revisar
        su estado.
    </p>

    <h2>Paso 1 - Petición:</h2>
    <p class="mb-32">
        Para realizar la consulta, necesitarás el "buyOrder" de la transacción de interés. Utiliza este identificador
        para efectuar una llamada a Oneclick.MallTransaction.
    </p>

    <x-snippet> $resp = $mallTransaction->status($buyOrder);</x-snippet>


    <h2>Paso 2: Respuesta</h2>
    <p class="mb-32">
        Transbank responderá con la siguiente información. Asegúrate de guardar esta respuesta, y la única validación
        necesaria es que el campo "response_code" sea igual a cero.
    </p>

    <x-snippet :content="$resp" />

</x-layout>
