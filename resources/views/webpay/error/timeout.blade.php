@php
    $navigation = ['timeout' => 'Time out'];
@endphp

<x-layout active-link="Webpay Plus" :navigation="$navigation">

    <h1 id="timeout">Webpay Plus - Time out</h1>
    <p class="mb-32">
        Cuando una transacción expira debido a un timeout, es crucial gestionar este escenario de manera adecuada para
        garantizar la transparencia y la experiencia del usuario, para la prueba en integración son de 10 minutos.
    </p>

    <h2>Datos recibidos:</h2>
    <p class="m-32">
        Después de 10 minutos en el que no se haya recibido ninguna acción o interacción del usuario, recibirás un
        GET con la siguiente información:
    </p>
    <x-snippet :content="$request->query()"></x-snippet>
</x-layout>
