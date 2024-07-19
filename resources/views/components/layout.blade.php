<!DOCTYPE html>
<html lang="en" data-theme="light" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ $title ?? 'Webpay Plus' }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/scrivo') }}">

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
