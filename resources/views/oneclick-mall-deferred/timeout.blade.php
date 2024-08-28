@php
    $navigation = ['timeout' => 'Time Out'];
@endphp

<x-layout active-link="Oneclick Mall Diferido" :navigation="$navigation">
    <h1 id="timeout">Oneclick Mall Diferido- Time out</h1>
    <p class="mb-32">
        Paso 1: Petición
        Cuando una transacción expira debido a un timeout, es crucial gestionar este escenario de manera adecuada para
        garantizar la transparencia y la experiencia del usuario, para la prueba en producción es de 10 minutos.
    </p>

    <h2>Datos Recibidos:</h2>
    <p class="mb-32">
        Después de 10 minutos en el que no se haya recibido ninguna acción o interacción del usuario, recibirás un POST
        con la siguiente información:</p>

    <x-snippet :content="$resp" />


</x-layout>
