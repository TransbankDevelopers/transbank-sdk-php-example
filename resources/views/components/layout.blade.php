<!DOCTYPE html>
<html lang="en" data-theme="light" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="trusted-domain" content="https://www.googletagmanager.com">
    <title>{{ $title ?? 'Transbank SDK' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-J1463PLZ6E"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-J1463PLZ6E');
    </script>
</head>

<body>
    <div class="main-container">
        @include('partials.header')
        <div class="body-container @if (empty($navigation)) no-nav @endif">
            <x-menu :active-link="$activeLink" />
            <div class="body-content ">
                {{ $slot }}
                @include('partials.channels')
            </div>
            <div class="helper-content">
                <x-navigation :navigation="$navigation ?? []" />
            </div>
        </div>

        @include('partials.footer')
    </div>
    @stack('scripts')
</body>

</html>
