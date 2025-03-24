@php
    $navigation = ['error' => 'Error en formulario de pago'];
@endphp

<x-layout active-link="Webpay Plus" :navigation="$navigation">

    <h1 id="error">Webpay Plus - Error en formulario de pago</h1>
    <p class="mb-32">
        Se ha producido un error en el formulario de pago. Si ha hecho clic
        en el botón &quot;Intentar nuevamente&quot; desde la pantalla de error
        después de cerrar inesperadamente la pestaña del navegador y trata
        de recuperarla, es posible que haya recibido los siguientes tokens:
        token_ws, TBK_TOKEN, TBK_ID_SESION, TBK_ORDEN_COMPRA.
    </p>

    <h2>Datos recibidos:</h2>
    <p class="m-32">
        Al producirse un error en el formulario de pago, recibirás un POST con la siguiente información:
    </p>
    <x-snippet :content="$request->all()"></x-snippet>
</x-layout>
