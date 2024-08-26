@php
    $navigation = ['delete' => 'Borrar usuario'];
@endphp

<x-layout active-link="Oneclick Mall" :navigation="$navigation">
    <h1 id="delete">Oneclick Mall - Borrar usuario</h1>
    <p class="mb-32">
        En este paso fundamental, procederemos a eliminar la inscripción del usuario y su medio de pago.
    </p>

    <h2>Paso 1: Petición</h2>
    <p class="mb-32">
        Para llevar a cabo la eliminación, necesitas el "userName" (Nombre de Usuario) y el "tbkUser". Realiza la
        llamada a Oneclick.MallInscription utilizando el siguiente código:
    </p>
    <x-snippet>
        $resp = $mallInscription->delete($tbkUser, $userName);
    </x-snippet>

    <h2>Paso 2: Respuesta</h2>
    <p class="mb-32">
        En caso de éxito, Transbank responderá con un status code 204 (No Content), y el SDK retornará un
        InsciptionDeleteResponse con success: true y code: (statuscode). La eliminación de la inscripción se ha
        realizado de manera exitosa.
    </p>

    <p class="mb-32">
        En el caso de que no se encuentre el "userName" o el "tbkUser", Transbank responderá con un status code 404 (Not
        Found), y el SDK retornará un InscriptionDeleteResponse con success: false y code: (statuscode).
    </p>

    <p class="mb-32">
        Este proceso garantiza una eliminación segura y eficiente de la inscripción del usuario y su medio de pago
        asociado. ¡Gracias por confiar en Transbank para tus operaciones seguras! Si tienes alguna pregunta, estamos
        aquí para ayudarte
    </p>

    <x-snippet :content="$resp" />

</x-layout>
