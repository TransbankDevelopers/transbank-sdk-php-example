@php
    $navigation = [
        'data' => 'Datos recibidos',
        'request' => 'Petición',
        'response' => 'Respuesta',
        'authorize' => 'Autorizar una transacción',
    ];
@endphp

<x-layout active-link="Oneclick Mall" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/oneclick-mall/start">Oneclick Mall</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="#">Finalizar inscripción</a>
        </div>
    </div>

    <h1>Oneclick Mall - Finalizar inscripción</h1>
    <p class="mb-32">
        En esta fase, completaremos el proceso de inscripción, permitiéndonos posteriormente realizar cargos a la
        tarjeta que el tarjetahabiente haya inscrito.
    </p>

    <h2 id="data">Paso 1: Datos recibidos</h2>
    <p class="mb-32">
        Después de finalizar el flujo en el formulario de inscripción, recibirás un GET con la siguiente información:
    </p>
    <x-snippet :content="$resp" />

    <h2 id="request">Paso 2: Petición de autorización</h2>
    <p class="mb-32">
        Utiliza el token recibido para finalizar la Inscripción mediante una nueva llamada a Oneclick.
    </p>

    <x-snippet>
        $resp = $mallInscription->finish($token);
    </x-snippet>

    <h2 id="response">Paso 3: Respuesta</h2>
    <p class="mb-32">
        Transbank responderá con información crucial. Guarda estos detalles, ya que serán necesarios para autorizar
        transacciones futuras.
    </p>

    <x-snippet :content="$resp" />

    <h2 id="authorize">¡La tarjeta ya está inscrita!</h2>
    <p class="mb-32">Con la inscripción exitosa se pueden autorizar transacciones.</p>

    <h2>Autorizar una transacción</h2>
    <p class="mb-32">
        Asegúrate de guardar los datos de la respuesta obtenidos durante la inscripción. Estos serán esenciales para
        llevar a cabo transacciones de manera efectiva.
    </p>

    <x-table :request="$table" />

    <p class="mt-32">Después de una inscripción exitosa, tienen dos opciones: autorizar un pago o borrar al usuario que
        se
        acaba de inscribir.</p>

    <form action={{ route('oneclick-mall.authorize') }} method="POST">
        @csrf
        <input type="hidden" name="userName" value="{{ $table['username'] }}">
        <input type="hidden" name="tbkUser" value="{{ $table['tbk_user'] }}">
        <div class="tbk-card">
            <p class="mb-16">Tienda 1</p>
            <div class="card-multi-field">
                <div class="input-container">
                    <label for="amountCommerce1" class="tbk-label">Monto:</label>
                    <input type="number" name="amountCommerce1" class="tbk-input-text" value="10000">
                </div>
                <div class="input-container">
                    <label for="installmentsCommerce1" class="tbk-label">Cuotas:</label>
                    <input type="number" name="installmentsCommerce1" class="tbk-input-text" value="0">
                </div>
            </div>
            <p class="mb-16 mt-32">Tienda 2</p>
            <div class="card-multi-field">
                <div class="input-container">
                    <label for="amountCommerce2" class="tbk-label">Monto:</label>
                    <input type="number" name="amountCommerce2" class="tbk-input-text" value="5000">
                </div>
                <div class="input-container">
                    <label for="installmentsCommerce2" class="tbk-label">Cuotas:</label>
                    <input type="number" name="installmentsCommerce2" class="tbk-input-text" value="0">
                </div>
            </div>
            <div class="tbk-card-footer">
                <button class="tbk-button primary">AUTORIZAR</button>
            </div>
        </div>
    </form>
    <a href={{ route('oneclick-mall.delete', ['userName' => $table['username'], 'tbkUser' => $table['tbk_user']]) }}
        class="tbk-button primary mb-32">
        BORRAR USUARIO
    </a>

</x-layout>
