@php
    $navigation = [
        'request' => 'Datos recibidos',
        'petition' => 'Petición',
        'response' => 'Respuesta',
        'form' => 'Formulario'
    ];
@endphp

<x-layout active-link="Patpass Comercio" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/patpass-comercio">Patpass Comercio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/patpass-comercio/commit">Confirmar registro</a>
        </div>
    </div>

    <h1>Patpass Comercio - Confirmar Registro</h1>
    <p class="mb-32">
        Es necesario confirmar el registro; este solo se puede hacer una sola vez o retornará error.
    </p>

    <h2 id="request">Paso 1: Datos recibidos</h2>
    <p class="mb-32">
        Luego de que se termina el flujo en el formulario de inscripción recibirás un POST con la siguiente respuesta.
    </p>
    <x-snippet>
        {
            "J_TOKEN": "{{ $j_token }}"
        }
    </x-snippet>

    <h2 id="petition">Paso 2: Petición</h2>
    <p class="mb-32">
        Usarás el token recibido para confirmar la inscripción usando el método status de PatpassComercio.
    </p>
    <x-snippet>
        use Transbank\PatpassComercio\Inscription;
        use Transbank\PatpassComercio\Options;
        use Transbank\PatpassComercio\PatpassComercio;
        // configuración de la transacción
        $option = new Options(
            PatpassComercio::INTEGRATION_API_KEY,
            PatpassComercio::INTEGRATION_COMMERCE_CODE,
            Options::ENVIRONMENT_INTEGRATION
        );
        $inscription = new Inscription($option);

        $resp = $inscription->status($token);
    </x-snippet>

    <h2 id="response">Paso 3: Respuesta</h2>
    <p class="mb-32">
        Transbank contestará con lo siguiente. Debes guardar esta información, lo único que debes validar es que el
        atributo authorized sea igual a true.
    </p>
    <x-snippet :content="$responsePayload" />

    <h2 id="form">¡Listo!</h2>
    <p class="mb-32">Una vez realizada la inscripción y confirmada, puedes visualizar el voucher.</p>
    <x-snippet tabulate="true">
        <form action="https://pagoautomaticocontarjetasint.transbank.cl/nuevo-ic-rest/tokenVoucherLogin" method="POST">
            <input type="hidden" name="tokenComercio" value="{{ $j_token }}"/>
            <input type="submit" value="Ver Voucher"/>
        </form>
    </x-snippet>

    <div class="tbk-card">
        <span class="tbk-card-title">Formulario de redirección</span>
        <div class="input-container mb-32">
            <label for="tokenComercio" class="tbk-label">Token</label>
            <input type="text" id="tokenComercio" class="tbk-input-text" value="{{ $j_token }}" disabled>
        </div>
        <div class="tbk-card-footer">
            <form action="{{ $resp->urlVoucher ?? 'https://pagoautomaticocontarjetasint.transbank.cl/nuevo-ic-rest/tokenVoucherLogin' }}"
                method="POST">
                <input type="hidden" name="tokenComercio" value="{{ $j_token }}">
                <button class="tbk-button primary">VER VOUCHER</button>
            </form>
        </div>
    </div>
</x-layout>
