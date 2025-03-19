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

            <p class="mb-16">
                Lo sentimos, pero se ha producido un error durante la integración con el SDK. El SDK
                devuelve una Exception.
            </p>
            <x-snippet :content="$error" />
            <p class="mb-32">Si este error persiste y crees que es necesario reportarlo, por favor, hazlo en nuestro
                repositorio de <a class="tbk-link" target="_blank" rel="noopener"
                    href="https://github.com/TransbankDevelopers/transbank-sdk-php-example/issues/new">GitHub.
                </a>
            </p>



            <a href="{{ route('home') }}" class="tbk-button primary mb-32">Volver</a>
        </main>
        @include('partials.footer')
    </div>
    @stack('scripts')
</body>

</html>
