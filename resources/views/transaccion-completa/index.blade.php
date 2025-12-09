@php
    $navigation = ['form' => 'formulario'];
@endphp

<x-layout active-link="Transacción Completa" :navigation="$navigation">
    <div id="form" class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/transaccion-completa">Webpay Transacción Completa</a>
        </div>
    </div>

    <h1>Transacción Completa - Formulario</h1>
    <p>En esta primera etapa necesitas obtener los datos esenciales de la tarjeta de crédito, débito o prepago del
        titular. Utiliza el formulario para recolectar esta información de manera segura.</p>
    <x-credit-card :action="route('transaccion-completa.create')" />
</x-layout>
