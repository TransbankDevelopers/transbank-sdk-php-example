<x-layout active-link="Oneclick Mall Diferido">
    <h2>Requisitos Previos:</h2>
    <p class="mb-16">Para realizar cualquier operación en esta sección, es necesario contar con el username y tbk_user
        que obtienes al crear la inscripción. Si aún no dispones de estos datos, puedes obtenerlos siguiendo las
        instrucciones detalladas en la sección
        <a class="tbk-link" href={{ url('/oneclick-mall-diferido/start') }}>Flujo Completo.</a>
    </p>

    <h2>Autorizar una transacción</h2>
    <p>Una vez realizada la inscripción, el comercio puede usar el tbkUser recibido para realizar transacciones. Para
        eso debes usar el método transaction.authorize(). Puedes revisar más detalles de esta operación en su
        <a target="_blank" href="https://www.transbankdevelopers.cl/documentacion/oneclick#autorizar-una-transaccion"
            class="tbk-link">documentación</a>
    </p>

    <livewire:oneclick-mall-deferred.authorize />

    <x-collapse :label="'Respuesta Autorización'">
        <x-table-object :rows="$oneclickMallDeferredAuthorize"></x-table-object>
    </x-collapse>

    <h2>Obtener estado de una transacción</h2>
    <p>Permite consultar el estado de pago realizado a través de Oneclick. Retorna el resultado de la autorización.
        Puedes revisar más detalles de esta operación en su <a target="_blank"
            href="https://www.transbankdevelopers.cl/documentacion/oneclick#reversar-o-anular-una-transaccion"
            class="tbk-link">documentación</a></p>

    <livewire:oneclick-mall-deferred.status />

    <x-collapse :label="'Respuesta Status'">
        <x-table-object :rows="$oneclickMallDeferredStatus"></x-table-object>
    </x-collapse>

    <h2>Capturar una transacción diferida</h2>
    <p>En el caso de que tengas contratada la modalidad de Captura diferida, necesitas llamar al método capture después
        de llamar a authorize para finalizar la transacción. Revisa más detalles sobre esta modalidad en la <a
            target="_blank" class="tbk-link"
            href="https://www.transbankdevelopers.cl/documentacion/oneclick#capturar-una-transaccion">documentación</a>
    </p>

    <livewire:oneclick-mall-deferred.capture />

    <x-collapse :label="'Respuesta captura diferida'">
        <x-table-object :rows="$oneclickMallDeferredCaptured"></x-table-object>
    </x-collapse>

    <h2>Reversar o Anular un pago</h2>
    <p>Esta operación permite a todo comercio habilitado, reversar o anular una transacción que fue generada en
        Oneclick. Puedes revisar más detalles de esta operación en su <a target="_blank"
            href="https://www.transbankdevelopers.cl/documentacion/oneclick#reversar-o-anular-una-transaccion"
            class="tbk-link">documentación</a>
    </p>

    <livewire:oneclick-mall-deferred.refund />

    <x-collapse :label="'Respuesta Reembolso'">
        <x-table-object :rows="$oneclickMallDeferredRefund"></x-table-object>
    </x-collapse>
</x-layout>
