@php
    $navigation = ['finish' => 'Finalizar inscripción', 'authorize' => 'Autorizar una transacción'];
@endphp

<x-layout active-link="Oneclick Mall Diferido" :navigation="$navigation">
    <h1 id="finish">Oneclick Mall Diferido - Finalizar inscripción</h1>
    <p class="mb-32">
        En esta fase, completaremos el proceso de inscripción, permitiéndonos posteriormente realizar cargos a la
        tarjeta que el tarjetahabiente haya inscrito.
    </p>

    <h2>Paso 1: Datos recibidos</h2>
    <p class="mb-32">
        Después de finalizar el flujo en el formulario de inscripción, recibirás un GET con la siguiente información:
    </p>
    <x-snippet :content="$resp" />

    <h2>Paso 2: Petición de autorización</h2>
    <p class="mb-32">
        Utiliza el token recibido para finalizar la Inscripción mediante una nueva llamada a Oneclick.
    </p>

    <x-snippet>
        $resp = $mallInscription->finish($token);
    </x-snippet>

    <h2>Paso 3: Respuesta</h2>
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

    <div class="tbk-card">
        <div class="divided-card">
            <p>Después de una inscripción exitosa, tienen dos opciones: autorizar un pago o borrar al usuario que se
                acaba de inscribir.</p>
            <div class="card-right-container">
                <a href={{ route('oneclick-mall-deferred.delete', ['userName' => $table['username'], 'tbkUser' => $table['tbk_user']]) }}
                    class="tbk-button primary">
                    BORRAR USUARIO
                </a>
                <a href={{ route('oneclick-mall-deferred.authorize', ['userName' => $table['username'], 'tbkUser' => $table['tbk_user']]) }}
                    class="tbk-button primary">AUTORIZAR UN PAGO</a>
            </div>
        </div>

    </div>

</x-layout>
