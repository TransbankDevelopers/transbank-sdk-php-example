<x-layout active-link="Webpay Plus">
    <h2>Requisitos Previos:</h2>
    <p class="mb-16 ">Para realizar cualquier operación en esta sección, es necesario contar con el token que obtienes al
        crear la
        transacción. Si aún no dispones del token puedes obtenerlo siguiendo las instrucciones detalladas en la sección
        <a class="tbk-link" href={{ url('/webpay-plus/create') }}>Flujo
            Completo.</a>
    </p>

    <h2>Obtener estado de una transacción</h2>
    <p>En condiciones normales es probable que no se requiera ejecutar, pero en caso de ocurrir un error inesperado
        permite conocer el estado y tomar las acciones que correspondan. La consulta de estado se puede realizar hasta 7
        días desde la creación de la transacción.
    </p>

    <livewire:webpay.status />

    <x-collapse :label="'Respuesta Status'">
        <x-table-object :rows="$webpayPlusStatus"></x-table-object>
    </x-collapse>

    <h2>Reversar o Anular un pago</h2>
    <p>Las transacciones de Webpay se pueden anular o reversar dadas algunas condiciones. Para cualquiera de éstas
        operaciones se utiliza el mismo servicio web que discernirá si se realizará una reversa o una anulación. para
        mas informacion sobre anulaciones a reversa visite <a target="_blank"
            href="https://www.transbankdevelopers.cl/producto/webpay#anulaciones-y-reversas" class="tbk-link">aqui</a>
    </p>

    <livewire:webpay.refund />

    <x-collapse :label="'Respuesta Refund'">
        <x-table-object :rows="$webpayPlusRefund"></x-table-object>
    </x-collapse>
</x-layout>
