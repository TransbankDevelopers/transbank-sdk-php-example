@php
    $navigation = ['request' => 'Petición', 'response' => 'Respuesta'];
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
            <a class="current-breadcrumb" href="#">Borrar usuario</a>
        </div>
    </div>
    <h1>Oneclick Mall - Borrar usuario</h1>
    <p class="mb-32">
        En este paso fundamental, procederemos a eliminar la inscripción del usuario y su medio de pago.
    </p>

    <h2 id="request">Paso 1: Petición</h2>
    <p class="mb-32">
        Para llevar a cabo la eliminación, necesitas el "userName" (Nombre de Usuario) y el "tbkUser". Realiza la
        llamada a Oneclick.MallInscription utilizando el siguiente código:
    </p>
    <x-snippet>
        $resp = $mallInscription->delete($tbkUser, $userName);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p class="mb-32">
        En caso de éxito, Transbank responderá con un status code 204 (No Content), y el SDK retornará un
        booleano con valor true. La eliminación de la inscripción se ha
        realizado de manera exitosa.
    </p>

    <p class="mb-32">
        En el caso de que no se encuentre el "userName" o el "tbkUser", Transbank responderá con un status code 404 (Not
        Found), y el SDK lanzará una excepción del tipo InscriptionDeleteException.
    </p>

    <p class="mb-32">
        Este proceso garantiza una eliminación segura y eficiente de la inscripción del usuario y su medio de pago
        asociado. ¡Gracias por confiar en Transbank para tus operaciones seguras! Si tienes alguna pregunta, estamos
        aquí para ayudarte
    </p>

    <x-snippet :content="$resp" />

</x-layout>
