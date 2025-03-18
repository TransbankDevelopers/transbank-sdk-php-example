@php
$navigation = ['recovery' => 'Inscripción anulada'];
@endphp

<x-layout active-link="Oneclick Mall" :navigation="$navigation">
    <h1 id="recovery">Oneclick Mall - Inscripción anulada</h1>
    <p class="mb-32">
        La inscripción ha sido anulada por el usuario. En esta instancia, la inscripción fue abandonada al seleccionar la opción 'Abandonar y volver al comercio'.
    </p>

    <h2>Datos Recibidos:</h2>
    <p class="mb-32">
        Después de que el usuario anule la inscripción en el formulario de pago, recibirás un GET con la siguiente información:
    </p>

    <x-snippet :content="$req" />

    <h2>¡Se abandonó la inscripción!</h2>
    <p class="mb-32">Este mensaje indica que la inscripción ha sido cancelada por decisión del usuario. Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos. Lamentamos cualquier inconveniente y agradecemos tu comprensión.
    </p>

</x-layout>
