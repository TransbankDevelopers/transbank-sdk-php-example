@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta', 'form' => 'Formulario', 'example' => 'Ejemplo'];
@endphp

<x-layout active-link="Patpass Comercio" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/patpass-comercio">Patpass Comercio</a>
        </div>
    </div>

    <h1>Patpass Comercio - Iniciar Transacción</h1>
    <p class="mb-16">
        En este paso inicial, procederemos a inscribir una tarjeta con el objetivo de obtener un identificador único.
        Esto nos permitirá redirigir al Tarjetahabiente hacia el formulario de inscripción en el siguiente paso.
    </p>
    <p class="mb-32">Todas las transacciones de este proyecto ejemplo son realizadas en ambiente de integración.</p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">
        Para comenzar, importa la librería PatpassComercio y luego inicia una inscripción. Tener en cuenta: Actualmente,
        el ambiente de integración no admite direcciones locales (como localhost, 127.0.0.1, 192.168..) en los atributos
        "url" y "finalUrl".
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

        $resp = $inscription->start(
            $returnUrl,
            $name,
            $lastName,
            $secondLastName,
            $rut,
            $serviceId,
            $finalUrl,
            $maxAmount,
            $phone,
            $cellPhone,
            $patpassName,
            $personEmail,
            $commerceEmail,
            $address,
            $city
        );
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p class="mb-32">Una vez iniciada la inscripción, recibirás los siguientes datos de respuesta:</p>
    <x-snippet>
        {
            "token": "{{ $resp->token }}",
            "url": "{{ $resp->urlWebpay }}"
        }
    </x-snippet>

    <h2 id="form">Paso 3: Creación del formulario</h2>
    <p class="mb-32">
        Utiliza los datos obtenidos durante la inscripción para generar un formulario, proporcionando al
        Tarjetahabiente una experiencia de inscripción fluida y segura.
    </p>
    <x-snippet tabulate="true">
        <form action="{{ $resp->urlWebpay }}" method="POST">
            <input type="hidden" name="tokenComercio" value="{{ $resp->token }}" />
            <input type="submit" value="Inscribir" />
        </form>
    </x-snippet>

    <h2 id="example">Ejemplo</h2>
    <p class="mb-32">Para poder iniciar la inscripción, se necesitan los siguientes datos:</p>
    <div class="mb-32">
        <x-table :request="$request" />
    </div>

    <form action="{{ $resp->urlWebpay }}" method="POST">
        <div class="tbk-card">
            <span class="tbk-card-title">Formulario de redirección</span>
            <div class="input-container mb-32">
                <label for="tokenComercio" class="tbk-label">Token</label>
                <input type="text" id="tokenComercio" class="tbk-input-text" value="{{ $resp->token }}" disabled>
                <input type="hidden" name="tokenComercio" value="{{ $resp->token }}">
            </div>
            <div class="tbk-card-footer">
                <button class="tbk-button primary">INSCRIBIR</button>
            </div>
        </div>
    </form>
</x-layout>
