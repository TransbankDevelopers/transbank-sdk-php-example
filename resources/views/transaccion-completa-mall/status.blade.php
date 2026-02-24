@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta'];
@endphp

<x-layout active-link="Transacción Completa Mall" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/transaccion-completa-mall">Webpay Transacción Completa Mall</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/transaccion-completa-mall/status">Estado de transacción</a>
        </div>
    </div>

    <h1>Transacción Completa Mall - Estado de transacción</h1>
    <p class="mb-32">En esta fase, tendrás la capacidad de solicitar el estado actual de una transacción hasta 7 días
        después de su realización. Es importante destacar que no hay límite en la cantidad de solicitudes de este tipo
        durante este período. Sin embargo, una vez transcurridos los 7 días, ya no podrás revisar el estado de la
        transacción.</p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">Para llevar a cabo la solicitud de estado, necesitarás el token correspondiente a la transacción
        de la cual deseas obtener información. Utiliza este token para realizar una llamada a
        TransaccionCompleta.MallTransaction.
    </p>
    <x-snippet>
        use Transbank\Webpay\TransaccionCompleta\MallTransaction;
        use Transbank\Webpay\Options;
        //configuración de la transacción
        $option = new Options(API_KEY, COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $transaction = new MallTransaction($option);
        $resp = $transaction->status($token);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p>Transbank responderá con la siguiente información. Asegúrate de guardar estos detalles; lo único que necesitas
        validar es que el campo "response_code" sea igual a cero.</p>

    <x-snippet :content="$respond_payload ?? $respond" />

</x-layout>
