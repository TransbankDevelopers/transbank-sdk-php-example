@php
$navigation = ['request' => 'Petición', 'response' => 'Respuesta', 'other' => 'Otras utilidades'];
@endphp

<x-layout active-link="Oneclick Mall Diferido" :navigation="$navigation">
    <h1>Oneclick Mall Diferido - Capturar pago</h1>
    <p class="mb-32">
        En este paso debemos capturar la transacción para realmente capturar el dinero que habia sido previamente
        reservado al hacer la transacción.

    </p>

    <h2 id="request">Paso 1: Peticion</h2>
    <p class="mb-32">
        Para capturar una transacción necesitaremos el código de comercio de la tienda hija y Orden de compra de la
        tienda hija, Código de autorización y monto a capturar. Se hace de la siguiente manera.
    </p>
    <x-snippet>
        $resp = $mallTransaction->capture($childCommerceCode, $childBuyOrder, $authorizationCode, $amount);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p class="mb-32">
        Una vez capturada la transacción, recibirás los siguientes datos de respuesta:
    </p>

    <x-snippet :content="$resp" />

    <h2>¡Transacción Capturada!</h2>

    <p class="mb-32">Con la transacción capturada, puedes mostrar al usuario una página de éxito de la transacción,
        proporcionándole la confirmación de que el proceso se ha completado con éxito.p>

    <h2 id="other">Otras Utilidades:</h2>
    <p class="mb-32">Después de confirmar la transacción, considera las siguientes
        utilidades adicionales:</p>

    <ul>
        <li>
            <span class="fw-700">Reembolsar:</span> Puedes reversar o anular el pago según ciertas condiciones
            comerciales.
        </li>
        <li>
            <span class="fw-700">Consultar Estado:</span> Hasta 7 días después de la transacción, podrás consultar el
            estado de la transacción.
        </li>
    </ul>


    <form action={{ route('oneclick-mall-deferred.refund') }} method="POST">
        @csrf
        <div class="tbk-card">
            <div class="card-multi-field">
                <div class="input-container">
                    <label for="buyOrder" class="tbk-label">Orden compra:</label>
                    <input type="text" name="buyOrder" class="tbk-input-text" value={{ $buyOrder }}>
                </div>
                <div class="input-container">
                    <label for="childBuyOrder" class="tbk-label">Orden compra (tienda hija):</label>
                    <input type="text" name="childBuyOrder" class="tbk-input-text" value={{ $req['childBuyOrder'] }}>
                </div>
                <div class="input-container">
                    <label for="childCommerceCode" class="tbk-label">Orden de compra (tienda hija):</label>
                    <input type="text" name="childCommerceCode" class="tbk-input-text"
                        value={{ $req['childCommerceCode'] }}>
                </div>
                <div class="input-container">
                    <label for="amount" class="tbk-label">Monto a reembolsar:</label>
                    <input type="text" name="amount" class="tbk-input-text" value={{ $req['amount'] }}>
                </div>
            </div>
            <div class="tbk-card-footer ">
                <button class="tbk-button primary">REEMBOLSAR</button>
            </div>
        </div>
    </form>

    <a href={{ route('oneclick-mall-deferred.status', ['buyOrder' => $buyOrder]) }}
        class="tbk-button primary mb-32">CONSULTAR ESTADO</a>

</x-layout>
