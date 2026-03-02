@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta', 'form' => 'Formulario'];
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
            <a class="current-breadcrumb" href="/transaccion-completa-mall-diferido/commit">Confirmar</a>
        </div>
    </div>

    <h1>Transacción Completa Mall Diferido - Confirmar Transacción</h1>
    <p class="mb-32">En este paso crucial, procederemos a confirmar la transacción con el objetivo de notificar a
        Transbank que hemos recibido la transacción de manera exitosa. Es fundamental destacar que si no se confirma la
        transacción, esta será caducada.</p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">Para confirmar la transacción, debes enviar el token correspondiente. En el caso de pagos a
        plazos, también debes incluir el ID de la consulta de cuotas. En algunos casos, será necesario proporcionar el
        índice del periodo diferido y un valor boolean indicando si se tomará el periodo de gracia.
    </p>
    <x-snippet>
        use Transbank\Webpay\TransaccionCompleta\MallTransaction;
        use Transbank\Webpay\Options;
        //configuración de la transacción
        $option = new Options(API_KEY, COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $transaction = new MallTransaction($option);

        $details = [
        [
        "commerce_code" => "597055555577",
        "buy_order" => "O-123",
        "id_query_installments" => 1,
        "deferred_period_index" => 0,
        "grace_period" => false
        ],
        [
        "commerce_code" => "597055555578",
        "buy_order" => "O-456",
        "id_query_installments" => 1,
        "deferred_period_index" => 0,
        "grace_period" => false
        ]
        ];

        $resp = $transaction->commit($token, $details);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p>Una vez que la transacción ha sido confirmada Transbank proporcionará la siguiente información. Es fundamental
        conservar esta respuesta y verificar que el campo "response_code" tenga un valor de cero y que el campo "status"
        sea "AUTHORIZED".</p>

    <x-snippet :content="$respond_payload ?? $respond" />

    <h2 id="form">¡Listo!</h2>
    <p class="mb-16">Ahora que se ha confirmado la transacción, puedes capturar el monto previamente autorizado.</p>

    <div class="mt-4">
        @foreach ($response_details as $detail)
            <form action="{{ route('transaccion-completa-mall-diferido.capture') }}" method="GET" class="mb-16">
                <div class="tbk-card">
                    <span class="tbk-card-title">Capturar</span>
                    <div class="input-container mb-32">
                        <label for="child_buy_order_{{ $loop->index }}" class="tbk-label">Orden de compra hijo</label>
                        <input type="text" id="child_buy_order_{{ $loop->index }}" class="tbk-input-text mb-16"
                            value="{{ $detail['buy_order'] ?? '' }}" readonly>
                        <label for="child_commerce_code_{{ $loop->index }}" class="tbk-label">Commerce Code
                            hijo</label>
                        <input type="text" id="child_commerce_code_{{ $loop->index }}" class="tbk-input-text mb-16"
                            value="{{ $detail['commerce_code'] ?? '' }}" readonly>
                        <label for="authorization_code_{{ $loop->index }}" class="tbk-label">Código de
                            autorización</label>
                        <input type="text" id="authorization_code_{{ $loop->index }}" class="tbk-input-text mb-16"
                            value="{{ $detail['authorization_code'] ?? '' }}" readonly>
                        <label for="amount_{{ $loop->index }}" class="tbk-label">Monto a capturar</label>
                        <input type="text" id="amount_{{ $loop->index }}" name="amount"
                            class="tbk-input-text mb-16" value="{{ $detail['amount'] ?? '' }}">

                        <input type="hidden" name="token" value="{{ $request['token'] }}">
                        <input type="hidden" name="childBuyOrder" value="{{ $detail['buy_order'] ?? '' }}">
                        <input type="hidden" name="childCommerceCode" value="{{ $detail['commerce_code'] ?? '' }}">
                        <input type="hidden" name="authorizationCode"
                            value="{{ $detail['authorization_code'] ?? '' }}">
                        <input type="hidden" name="parentBuyOrder" value="{{ $respond_payload['buy_order'] ?? '' }}">
                    </div>
                    <div class="tbk-card-footer">
                        <button type="submit" class="tbk-button primary">CAPTURAR</button>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
</x-layout>
