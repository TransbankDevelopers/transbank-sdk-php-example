@php
    $navigation = ['request' => 'Petición', 'form' => 'Formulario'];
@endphp

<x-layout active-link="Transacción Completa" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/transaccion-completa">Webpay Transaccion Completa</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/transaccion-completa/create">Crear Transaccion</a>
        </div>

    </div>

    <h1>Transacción Completa - Crear transacción</h1>
    <p class="mb-32">En este paso sucede la creación de la transacción con el objetivo de obtener un identificador
        único para la
        misma.</p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">Comienza importando la librería TransaccionCompleta, y a continuación, crea la transacción
        necesaria.</p>
    <x-snippet>
        use Transbank\Webpay\TransaccionCompleta\Transaction;
        use Transbank\Webpay\Options;
        //configuración de la transacción
        $option = new Options(API_KEY, COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $transaction = new Transaction($option);
        $response = $resp = $transaction->create($buyOrder, $sessionId, $amount, $cardNumber, $cardExpiry, $cvv);
    </x-snippet>
    <h2 id="response">Paso 2: Respuesta</h2>
    <p> Una vez creada la transacción, recibirás los siguientes datos de respuesta:</p>

    <x-snippet :content="$respond" />

    <h2 id="form">¡Transacción creada!</h2>
    <p class="mb-16">Ahora que hemos creado la transacción, se abren dos opciones para continuar:</p>
    <ul class="mb-32">
        <li>
            <span class="fw-700">Consultar Cuotas(opcional):</span> Alternativamente puedes realizar consultas de cuotas
            para ofrecer opciones de pago a plazos.
        </li>
        <li>
            <span class="fw-700">Confirmar Transacción: </span> Debes confirmar directamente la transacción para
            finalizar con el proceso de pago.
        </li>
    </ul>
    <form action="{{ route('transaccion-completa.installments') }}" method="POST">
        @csrf
        <div class="tbk-card">
            <span class="tbk-card-title">Formulario de redirección</span>
            <div class="input-container">
                <label for="installments_number" class="tbk-label">N° de cuotas:</label>
                <input type="text" name="installments_number" class="tbk-input-text" value="3">
                <input type="hidden" name="token" class="tbk-input-text" value="{{ $respond->token }}">
            </div>
            <div class="tbk-card-footer">
                <button class="tbk-button primary mr-16 ">CONSULTAR CUOTAS</button>
                <a href="{{ route('transaccion-completa.commit', ['token' => $respond->token]) }}"
                    class="tbk-button primary">CONFIRMAR</a>
            </div>
        </div>
    </form>


</x-layout>
