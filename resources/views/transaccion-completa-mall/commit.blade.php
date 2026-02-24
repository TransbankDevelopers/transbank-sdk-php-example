@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta', 'form' => 'Formulario'];
    $responseDetails = $respond->details ?? ($details ?? []);
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
            <a class="current-breadcrumb" href="/transaccion-completa-mall/commit">Confirmar</a>
        </div>
    </div>

    <h1>Transacción Completa Mall - Confirmar Transacción</h1>
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
        "commerce_code" => "597055555574",
        "buy_order" => "O-123",
        "id_query_installments" => 1,
        "deferred_period_index" => 0,
        "grace_period" => false
        ],
        [
        "commerce_code" => "597055555575",
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
    <p class="mb-16">Con la transacción confirmada, puedes mostrar al usuario una página de éxito de la transacción,
        proporcionándole la confirmación de que el proceso se ha completado con éxito.</p>

    <p>Después de confirmar la transacción, podrás realizar otras operaciones útiles:</p>
    <ul>
        <li><span class="fw-700">Reembolsar:</span> Puedes reversar o anular el pago según ciertas condiciones
            comerciales.</li>
        <li><span class="fw-700">Consultar Estado:</span> Hasta 7 días después de realizada la transacción, podrás
            consultar el estado de la transacción.</li>
    </ul>

    @foreach ($responseDetails as $detail)
        @php
            $detailAmount = $detail->amount ?? ($detail['amount'] ?? '');
            $detailBuyOrder = $detail->buy_order ?? ($detail['buy_order'] ?? '');
            $detailCommerceCode = $detail->commerce_code ?? ($detail['commerce_code'] ?? '');

        @endphp
        <form action="{{ route('transaccion-completa-mall.refund') }}" method="GET">
            <div class="tbk-card">

                <div class="refund-card-inputs mb-32">
                    <div class="flex-col">
                        <label class="tbk-label">Orden de Compra Tienda</label>
                        <input type="text" class="tbk-input-text" value="{{ $detailBuyOrder }}" readonly>
                    </div>

                    <div class="flex-col">
                        <label class="tbk-label">Código de Comercio</label>
                        <input type="text" class="tbk-input-text" value="{{ $detailCommerceCode }}" readonly>
                    </div>
                    <div class="flex-col">
                        <label for="amount" class="tbk-label">Monto a reembolsar</label>
                        <input type="text" id="amount" name="amount" class="tbk-input-text"
                            value="{{ $detailAmount }}">
                    </div>
                    <input type="hidden" name="token" value="{{ $request['token'] }}">
                    <input type="hidden" name="buyOrder" value="{{ $detailBuyOrder }}">
                    <input type="hidden" name="childCommerceCode" value="{{ $detailCommerceCode }}">
                </div>

                <div class="tbk-card-footer">
                    <button type="submit" class="tbk-button primary">REEMBOLSAR</button>
                </div>
            </div>
        </form>
    @endforeach

    <a href="{{ route('transaccion-completa-mall.status', ['token' => $request['token']]) }}"
        class="tbk-button primary mb-32">CONSULTAR ESTADO</a>
</x-layout>
