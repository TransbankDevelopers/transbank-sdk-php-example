@php
    $navigation = ['cancel' => 'Estado de compra cancelada', 'state' => 'Consulta de estado de transacción'];
@endphp

<x-layout active-link="Webpay Plus" :navigation="$navigation">

    <h1 id="cancel">Webpay Plus - Estado de compra cancelada</h1>
    <p class="mb-32">
        El pago de la compra ha sido anulado por el usuario. En esta etapa, después de abandonar el
        formulario de pago, no es necesario realizar la confirmación. Aquí te proporcionamos información esencial sobre
        el estado de la transacción anulada:
    </p>

    <h2>Datos recibidos:</h2>
    <p class="m-32">
        Después de completar el flujo en el formulario de pago, recibirás un GET con la siguiente
        información:
    </p>
    <x-snippet :content="$request->query()"></x-snippet>

    <h2>Otras Utilidades</h2>
    <p class="mb-32">
        Tras la anulación de la compra, solo podrás consultar el estado de la transacción en los próximos 7 días después
        de su realización. Asegúrate de realizar las consultas dentro de este período.
    </p>

    <h1 id="state">Consulta de Estado de Transacción</h1>
    <p class="mb-32">
        Puedes solicitar el estado de una transacción hasta 7 días después de su realización. No hay límite de
        solicitudes de este tipo durante ese período. Sin embargo, después de pasar los 7 días, ya no podrás revisar el
        estado de la transacción.
    </p>

    <h2>Paso 1: Petición</h2>
    <p class="mb-32">
        Para realizar la consulta, necesitas el token de la transacción de la cual deseas obtener el estado. Utiliza
        este token para realizar una llamada al SDK.
    </p>

    <x-snippet>
        // Token: {{ $request->query('TBK_TOKEN') }}
        $resp = $transaction->status($token);
    </x-snippet>

    <h2>Paso 2: Respuesta</h2>
    <p class="mb-32">
        Una vez que hayas creado la transacción, aquí encontrarás los datos de respuesta generados por el proceso.
    </p>

    <x-snippet :content="$resp" />
</x-layout>
