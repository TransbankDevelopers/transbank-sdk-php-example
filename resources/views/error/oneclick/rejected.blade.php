@php
$navigation = ['rejected' => 'Rechazo Bancario'];
@endphp

<x-layout active-link={{ $product }} :navigation="$navigation">
    <h1>{{ $product }} - Rechazo Bancario</h1>
    <p class="mb-32">
        En esta fase, pueden surgir inconvenientes, ya sea con el titular de la tarjeta o a nivel bancario, lo que
        resulta en una inscripción fallida.
    </p>

    <h2 id="data">Paso 1: Datos recibidos</h2>
    
    <x-snippet :content="$resp" />

</x-layout>
