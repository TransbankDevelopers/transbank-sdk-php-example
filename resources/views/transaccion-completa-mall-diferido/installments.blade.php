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
            <a class="current-breadcrumb" href="/transaccion-completa-mall-diferido/installments">Consulta de cuotas</a>
        </div>
    </div>

    <h1>Transacción Completa Mall Diferido - Consulta de cuotas</h1>
    <p class="mb-32">En esta etapa, realizaremos una consulta de cuotas para conocer sus condiciones. Es importante
        destacar que este paso es opcional y se utiliza únicamente si deseas ofrecer opciones de pago a plazos.</p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">Para llevar a cabo la consulta de cuotas, debemos enviar los siguientes datos relevantes.</p>
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
        "installments_number" => 3
        ],
        [
        "commerce_code" => "597055555578",
        "buy_order" => "O-456",
        "installments_number" => 3
        ]
        ];

        $resp = $transaction->installments($token, $details);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p>Una vez realizada la consulta de cuotas, recibirás los siguientes datos de respuesta:</p>

    <x-snippet :content="$respond" />

    <h2 id="form">Confirmar Transacción</h2>
    <p class="mb-16">Si decides utilizar cuotas y estás satisfecho con las condiciones obtenidas en la consulta, el
        siguiente paso sería confirmar la transacción.</p>

    <div class="tbk-card">
        <div class="input-container mb-16">
            <label for="token" class="tbk-label">Token</label>
            <input type="text" id="token" name="token" class="tbk-input-text" value="{{ $request['token'] }}">
        </div>
        <div class="input-container mb-16">
            <label for="idQueryInstallments" class="tbk-label">ID de consulta de cuotas (Opcional)</label>
            <input type="text" id="idQueryInstallments" name="idQueryInstallments" class="tbk-input-text"
                value="{{ $respond[0]->idQueryInstallments ?? '' }}">
        </div>
        <div class="input-container mb-16">
            <label for="deferredPeriodIndex" class="tbk-label">Indice de periodo diferido (opcional)</label>
            <input type="text" id="deferredPeriodIndex" name="deferredPeriodIndex" class="tbk-input-text"
                value="">
        </div>
        <div class="input-container mb-16">
            <label for="gracePeriod" class="tbk-label">Periodo de gracia (opcional)</label>
            <input type="text" id="gracePeriod" name="gracePeriod" class="tbk-input-text" value="">
        </div>

        <div class="tbk-card-footer">
            <a href="#" id="confirmLink" class="tbk-button primary">CONFIRMAR TRANSACCIÓN</a>
        </div>
    </div>

    @push('scripts')
        <script>
            const tokenInput = document.getElementById('token');
            const idQueryInstallmentsInput = document.getElementById('idQueryInstallments');
            const deferredPeriodIndexInput = document.getElementById('deferredPeriodIndex');
            const gracePeriodInput = document.getElementById('gracePeriod');
            const confirmLink = document.getElementById('confirmLink');

            function updateLink() {
                const token = tokenInput.value;
                const idQueryInstallments = idQueryInstallmentsInput.value;
                const deferredPeriodIndex = deferredPeriodIndexInput.value;
                const gracePeriod = gracePeriodInput.value;

                const params = new URLSearchParams();
                if (token) params.append('token', token);
                if (idQueryInstallments) params.append('idQueryInstallments', idQueryInstallments);
                if (deferredPeriodIndex) params.append('deferredPeriodIndex', deferredPeriodIndex);
                if (gracePeriod) params.append('gracePeriod', gracePeriod);

                confirmLink.href = "{{ route('transaccion-completa-mall-diferido.commit') }}?" + params.toString();
            }

            tokenInput.addEventListener('input', updateLink);
            idQueryInstallmentsInput.addEventListener('input', updateLink);
            deferredPeriodIndexInput.addEventListener('input', updateLink);
            gracePeriodInput.addEventListener('input', updateLink);

            updateLink();
        </script>
    @endpush
</x-layout>
