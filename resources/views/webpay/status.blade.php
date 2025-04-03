@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta'];
@endphp

<x-layout active-link="Webpay Plus" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">

            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/webpay-plus/create">Webpay Plus</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/webpay-plus/status?token={{ $req['token'] }}">
                Consultar estado de transacción</a>
        </div>
    </div>
    <h1>Webpay Plus - Consultar estado de transacción</h1>
    <p class="mb-32">Puedes solicitar el estado de una transacción hasta 7 días después de su realización. No hay
        límite
        de solicitudes de este tipo durante ese período. Sin embargo, una vez pasados los 7 días, ya no podrás revisar
        su estado.
    </p>

    <h2 id="request">Paso 1 - Petición:</h2>
    <p class="mb-32">
        Para realizar la consulta, necesitas el token de la transacción de la cual deseas obtener el estado. Utiliza
        este token para realizar una llamada a WebpayPlus.Transaction.
    </p>

    <x-snippet> $resp = $transaction->status($token);</x-snippet>


    <h2 id="response">Paso 2: Respuesta</h2>
    <p class="mb-32">
        Transbank responderá con la siguiente información. Asegúrate de guardar esta respuesta, y la única validación
        necesaria es que el campo "response_code" sea igual a cero.
    </p>

    <x-snippet :content="$resp" />

</x-layout>
