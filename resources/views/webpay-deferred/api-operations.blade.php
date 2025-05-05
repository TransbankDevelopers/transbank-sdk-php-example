<x-layout active-link="Webpay Plus Diferido">
    <h2>Requisitos Previos:</h2>
    <p class="mb-16 ">Para realizar cualquier operación en esta sección, es necesario contar con el token que obtienes al
        crear la
        transacción. Si aún no dispones del token puedes obtenerlo siguiendo las instrucciones detalladas en la sección
        <a class="tbk-link" href={{ url('/webpay-plus-diferido/create') }}>Flujo
            Completo.</a>
    </p>

    <h2>Obtener estado de una transacción diferida</h2>
    <p>En condiciones normales es probable que no se requiera ejecutar, pero en caso de ocurrir un error inesperado
        permite conocer el estado y tomar las acciones que correspondan. La consulta de estado se puede realizar hasta 7
        días desde la creación de la transacción.
    </p>

    <livewire:webpay-deferred.status />

    <x-collapse :label="'Respuesta Status'">
        <x-tableObject :rows="$webpayPlusStatus"></x-tableObject>
    </x-collapse>

    <h2>Capturar una transacción diferida</h2>
    <p>
        Permite solicitar a Webpay la captura diferida de una transacción con autorización y sin captura simultánea.
        Puedes revisar más detalles de esta operación en su <a target="_blank" class="tbk-link"
            href="https://www.transbankdevelopers.cl/documentacion/webpay-plus#capturar-una-transaccion">documentación</a>
    </p>

    <livewire:webpay-deferred.capture />

    <x-collapse :label="'Respuesta captura diferida'">
        <x-tableObject :rows="$webpayPlusDeferredCaptured"></x-tableObject>
    </x-collapse>

    <h2>Reversar o Anular un pago diferido</h2>
    <p>Las transacciones de Webpay se pueden anular o reversar dadas algunas condiciones. Para cualquiera de éstas
        operaciones se utiliza el mismo servicio web que discernirá si se realizará una reversa o una anulación. para
        mas informacion sobre anulaciones a reversa visite <a target="_blank"
            href="https://www.transbankdevelopers.cl/producto/webpay#anulaciones-y-reversas" class="tbk-link">aqui</a>
    </p>

    <livewire:webpay-deferred.refund />

    <x-collapse :label="'Respuesta Refund'">
        <x-tableObject :rows="$webpayPlusRefund"></x-tableObject>
    </x-collapse>


</x-layout>
