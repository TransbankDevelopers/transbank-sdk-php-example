<!DOCTYPE html>
<html lang="en" data-theme="light" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transbank Developers</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="layout-home">
        @include('partials.header')

        <main class="layout-error">


            <h1>¡Ha ocurrido un error!</h1>

            <p class="mb-16">Lo sentimos, pero se ha producido un error durante la integración con el SDK. El SDK
                devuelve errores
                de
                tipo
                "TransbankError". Si estás viendo otro tipo de error, es posible que el proyecto de ejemplo tenga
                algún
                problema.

            </p>
            <p class="mb-32">Si este error persiste y crees que es necesario reportarlo, por favor, hazlo en nuestro
                repositorio
                de
                GitHub.
            </p>

            <x-snippet :content="$error" />

            <a href="{{ route('home') }}" class="tbk-button primary">Volver</a>
        </main>
        @include('partials.footer')
    </div>
    @stack('scripts')
</body>

</html>
