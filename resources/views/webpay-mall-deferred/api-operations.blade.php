<x-layout active-link="Webpay Mall Diferido">
    <h2>Requisitos Previos:</h2>
    <p class="mb-16">Para realizar cualquier operación en esta sección, es necesario contar con el token que obtienes al
        crear la transacción. Si aún no dispones del token puedes obtenerlo siguiendo las instrucciones detalladas en la
        sección
        <a class="tbk-link" href={{ url('/webpay-mall-diferido/create') }}>Flujo
            Completo.</a>
    </p>

    <h2>Obtener estado de una transacción</h2>
    <p class="mb-16">En condiciones normales es probable que no se requiera ejecutar, pero en caso de ocurrir un error
        inesperado
        permite conocer el estado y tomar las acciones que correspondan. La consulta de estado se puede realizar hasta 7
        días desde la creación de la transacción.
    </p>
    <p>Puedes revisar más detalles de esta operación en su
        <a target="_blank" class="tbk-link"
            href="https://www.transbankdevelopers.cl/documentacion/webpay-plus#obtener-estado-de-una-transaccion-mall">documentación.</a>
    </p>

    <livewire:webpay-mall-deferred.status />

    <x-collapse :label="'Respuesta Status'">
        <x-table-object :rows="$webpayPlusStatus"></x-table-object>
    </x-collapse>

    <h2>Capturar una transacción diferida</h2>
    <p>
        Permite solicitar a Webpay la captura diferida de una transacción con autorización y sin captura simultánea.
        Puedes revisar más detalles de esta operación en su <a target="_blank" class="tbk-link"
            href="https://www.transbankdevelopers.cl/documentacion/webpay-plus#capturar-una-transaccion-mall">documentación.</a>
    </p>

    <livewire:webpay-mall-deferred.capture />

    <x-collapse :label="'Respuesta captura diferida'">
        <x-table-object :rows="$webpayPlusCaptured"></x-table-object>
    </x-collapse>

    <h2>Reversar o Anular un pago</h2>
    <p>Las transacciones de Webpay Mall se pueden anular o reversar dadas algunas condiciones. Para cualquiera de éstas
        operaciones se utiliza el mismo servicio web que discernirá si se realizará una reversa o una anulación. Para
        más información sobre anulaciones y reversas visite <a target="_blank"
            href="https://www.transbankdevelopers.cl/producto/webpay#anulaciones-y-reversas" class="tbk-link">aquí.</a>
    </p>

    <livewire:webpay-mall-deferred.refund />

    <x-collapse :label="'Respuesta Refund'">
        <x-table-object :rows="$webpayPlusRefund"></x-table-object>
    </x-collapse>
</x-layout>
