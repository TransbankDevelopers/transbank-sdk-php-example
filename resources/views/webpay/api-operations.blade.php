<x-layout active-link="Webpay Plus">
    <h2>Requisitos Previos:</h2>
    <p class="mb-16 ">Para realizar cualquier operación en esta sección, es necesario contar con el token que obtienes al
        crear la
        transacción. Si aún no dispones del token puedes obtenerlo siguiendo las instrucciones detalladas en la sección
        <a class="tbk-link" target="_blank" href="https://transbank-sdk-nodejs-example.continuumhq.dev/webpay-plus">Flujo
            Completo.</a>
    </p>

    <h2>Obtener estado de una transacción
    </h2>

    <p>En condiciones normales es probable que no se requiera ejecutar, pero en caso de ocurrir un error inesperado
        permite conocer el estado y tomar las acciones que correspondan. La consulta de estado se puede realizar hasta 7
        días desde la creación de la transacción.
    </p>

    <form action="{{ route('webpay.status-api') }}" method="POST">
        @csrf
        <div class="tbk-card">
            <h3 class="tbk-card-title">transaction.status()</h3>
            <div class="input-container">
                <label for="token" class="tbk-label">Token</label>
                <input type="text" name="token" class="tbk-input-text" required>

            </div>
            <div class="tbk-card-footer">
                <button class="tbk-button primary">Status</button>
            </div>
            @if (isset($statusResponse))
                <x-snippet :content="$statusResponse" />
            @endif
        </div>
    </form>

    <x-collapse :label="'Respuesta Status'">
        <x-tableObject :rows="$webpayPlusStatus"></x-tableObject>
    </x-collapse>


    <h2>Reversar o Anular un pago</h2>
    <p>Las transacciones de Webpay se pueden anular o reversar dadas algunas condiciones. Para cualquiera de éstas
        operaciones se utiliza el mismo servicio web que discernirá si se realizará una reversa o una anulación. para
        mas informacion sobre anulaciones a reversa visite <a target="_blank"
            href="https://www.transbankdevelopers.cl/producto/webpay#anulaciones-y-reversas" class="tbk-link">aqui</a>
    </p>

    <form action="{{ route('webpay.refund-api') }}" method="POST">
        @csrf
        <div class="tbk-card">
            <h3 class="tbk-card-title">transaction.refund()</h3>
            <div class="input-container  mb-32">
                <label for="token" class="tbk-label">Token</label>
                <input type="text" name="token" class="tbk-input-text" required>
            </div>
            <div class="input-container">
                <label class="tbk-label" for="amount">Monto</label>
                <input name="amount" type="number" class="tbk-input-text" required>
            </div>

            <div class="tbk-card-footer">
                <button class="tbk-button primary">Refund</button>
            </div>

            @if (isset($refundResponse))
                <x-snippet :content="$refundResponse" />
            @endif
        </div>
    </form>

    <x-collapse :label="'Respuesta Refund'">
        <x-tableObject :rows="$webpayPlusRefund"></x-tableObject>
    </x-collapse>

</x-layout>
