@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta'];
@endphp

<x-layout active-link="Oneclick Mall Promociones" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/promotions-oneclick-mall">Oneclick Mall Promociones</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/promotions-oneclick-mall/info-bin?tbk_user={{ $tbkUser }}">Consulta
                servicio de bines</a>
        </div>
    </div>

    <h1>Oneclick Mall Promociones - Consulta servicio de bines</h1>
    <p class="mb-32">
        Con esta operación puedes consultar el BIN asociado al medio de pago inscrito usando el valor de
        <code>tbk_user</code>. Si el comercio no tiene habilitado este servicio, la respuesta incluirá un error.
    </p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">
        Para realizar la consulta, necesitarás el <code>tbk_user</code> obtenido al finalizar la inscripción.
        Utiliza ese identificador para llamar a <code>Oneclick.MallBinInfo</code>.
    </p>

    <x-snippet>
        use Transbank\Webpay\Oneclick\MallBinInfo;

        $mallBinInfo = new MallBinInfo($option);
        $resp = $mallBinInfo->queryBin($tbkUser);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p class="mb-32">
        Transbank responderá con la información del BIN consultado.
    </p>

    <div class="mb-32">
        <x-table :request="['tbk_user' => $tbkUser]" />
    </div>

    <x-snippet :content="$resp" />
</x-layout>
