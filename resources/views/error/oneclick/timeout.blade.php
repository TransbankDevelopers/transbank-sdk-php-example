@php
$navigation = ['timeout' => 'Time out'];
@endphp

<x-layout active-link={{ $product }} :navigation="$navigation">
    <h1>{{ $product }} - Time out</h1>
    <p class="mb-32">
        Cuando una inscripción expira debido a un timeout, es crucial gestionar este escenario de manera adecuada para
        garantizar la transparencia y la experiencia del usuario, para la prueba en producción es de 10 minutos.
    </p>

    <h2 id="data">Datos Recibidos:</h2>
    <p class="mb-32">
        Después de 10 minutos en el que no se haya recibido ninguna acción o interacción del usuario,
        recibirás un GET con la siguiente información:</p>

    <x-snippet :content="$resp" />


</x-layout>

