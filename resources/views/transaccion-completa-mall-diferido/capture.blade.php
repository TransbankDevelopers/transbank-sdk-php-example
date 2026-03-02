@php
    $navigation = ['confirmar' => 'Confirmar', 'confirm' => 'Otras Utilidades'];
@endphp

<x-layout active-link="Transacción Completa Mall Diferido" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/transaccion-completa-mall-diferido">Webpay Transacción Completa Mall Diferido</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/transaccion-completa-mall-diferido/capture">Capturar</a>
        </div>
    </div>

    <h1>Transacción Completa Mall Diferido - Capturar transacción</h1>
    <p class="mb-32">En este paso debemos capturar la transacción para realmente capturar el dinero que habia sido
        previamente reservado al hacer la transacción.</p>

    <h2 id="confirmar">Paso 1: Petición</h2>
    <p class="mb-32">Para capturar una transacción, necesitaremos el Token, la Orden de compra, el Código de autorización
        y el monto a capturar.</p>

    <x-snippet>
        use Transbank\Webpay\TransaccionCompleta\MallTransaction;
        use Transbank\Webpay\Options;
        //configuración de la transacción
        $option = new Options(API_KEY, COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $transaction = new MallTransaction($option);
        $resp = $transaction->capture($token, $childCommerceCode, $childBuyOrder, $authorizationCode, $amount);
    </x-snippet>

    <h2 id="confirm">Paso 2: Respuesta</h2>
    <x-snippet :content="$respond" />

    <h2 class="mt-32">¡Listo!</h2>
    <p>Después de capturar la transacción, podrás realizar otras operaciones útiles:</p>

    <form action="{{ route('transaccion-completa-mall-diferido.refund') }}" method="GET" class="mb-16">
        <div class="tbk-card">
            <div class="input-container mb-32">
                <label class="tbk-label">Monto a reembolsar</label>
                <input type="text" name="amount" class="tbk-input-text" value="{{ $request['amount'] ?? '' }}">
                <input type="hidden" name="token" value="{{ $request['token'] }}">
                <input type="hidden" name="buyOrder" value="{{ $request['childBuyOrder'] }}">
                <input type="hidden" name="childCommerceCode" value="{{ $request['childCommerceCode'] }}">
            </div>
            <div class="tbk-card-footer">
                <button type="submit" class="tbk-button primary">REEMBOLSAR</button>
            </div>
        </div>
    </form>

    <a href="{{ route('transaccion-completa-mall-diferido.status', ['token' => $request['token']]) }}"
        class="tbk-button primary mb-32">CONSULTAR ESTADO</a>
</x-layout>
