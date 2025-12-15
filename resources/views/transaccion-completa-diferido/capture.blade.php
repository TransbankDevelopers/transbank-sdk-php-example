@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta', 'form' => 'Formulario'];
@endphp

<x-layout active-link="Transacción Completa" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/transaccion-completa-diferido">Webpay Transacción Completa Diferido</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/transaccion-completa-diferido/capture">Capturar Transacción</a>
        </div>

    </div>

    <h1>Transacción Completa Diferido - Capturar transacción</h1>
    <p class="mb-32">En este paso debemos capturar la transacción para realmente capturar el dinero que habia sido
        previamente reservado al hacer la transacción.</p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">Para capturar una transacción, necesitaremos el Token, la Orden de compra, el Código de
        autorización y el monto a capturar.
    </p>
    <x-snippet>
        use Transbank\Webpay\TransaccionCompleta\Transaction;
        use Transbank\Webpay\Options;
        //configuración de la transacción
        $option = new Options(API_KEY, COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $transaction = new Transaction($option);
        $response = $transaction->capture($token, $buyOrder, $authorizationCode, $captureAmount);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p>Una vez Capturada la transacción, recibirás los siguientes datos de respuesta:</p>

    <x-snippet :content="$respond" />

    <h2 id="form">¡Listo!</h2>
    <p class="mb-16">Con la transacción capturada, puedes mostrar al usuario una página de éxito de la transacción,
        proporcionándole la confirmación de que el proceso se ha completado con éxito.</p>

    <p>Después de Capturar la transacción, podrás realizar otras operaciones útiles:</p>
    <ul>
        <li><span class="fw-700">Reembolsar:</span> Puedes reversar o anular el pago según ciertas condiciones
            comerciales.</li>
        <li><span class="fw-700">Consultar Estado:</span> Hasta 7 días después de realizada la transacción, podrás
            consultar el estado de la transacción.</li>
    </ul>

    <form action="{{ route('transaccion-completa-diferido.refund') }}" method="GET">
        <div class="tbk-card">
            <div class="input-container mb-32">
                <label for="amount" class="tbk-label">Monto a reembolsar</label>
                <input type="text" id="amount" name="amount" class="tbk-input-text" value="{{ $amount }}">
                <input type="hidden" name="token" value="{{ $request['token'] }}">
            </div>

            <div class="tbk-card-footer">
                <button type="submit" class="tbk-button primary">REEMBOLSAR</button>
            </div>
        </div>
    </form>

    <a href="{{ route('transaccion-completa-diferido.status', ['token' => $request['token']]) }}"
        class="tbk-button primary mb-32">CONSULTAR ESTADO</a>

</x-layout>
