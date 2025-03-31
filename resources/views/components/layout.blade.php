<!DOCTYPE html>
<html lang="en" data-theme="light" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Webpay Plus' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

</head>

<body>
    <div class="main-container">
        @include('partials.header')
        <div class="body-container">

            <x-menu :active-link="$activeLink" />
            <div class="body-content">
                {{ $slot }}
                @include('partials.channels')
            </div>
            <div class="helper-content">
                <x-navigation :navigation="$navigation" />
            </div>
        </div>

        @include('partials.footer')
    </div>
    @stack('scripts')
</body>

</html>
