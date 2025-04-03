<!DOCTYPE html>
<html lang="en" data-theme="light" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="trusted-domain" content="https://www.googletagmanager.com">
    <title>Transbank SDK</title>
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
    <div class="layout-home">
        @include('partials.header')
        <div class="flex-col">
            <div class="tbk-home-container">
                <h1 class="title">Proyectos de Ejemplo del SDK para PHP</h1>
                <div class="tbk-home-intro">
                    <Image src="{{ asset('images/php-img.svg') }}" alt="Node.js Logo" class="self-center" width="168"
                        height="120" class="aling-self-start" />
                    <p class="tbk-home-text">
                        Este proyecto te brinda la oportunidad experimentar con las diversas
                        modalidades de productos que Transbank ofrece a través de su SDK
                        compatible con PHP. Conoce de manera práctica las soluciones y
                        servicios que Transbank pone a tu disposición, permitiéndote
                        comprender cómo integrar estas herramientas tecnológicas en tus
                        proyectos y aplicaciones. ¡Explora las opciones disponibles y
                        descubre cómo aprovechar al máximo estas capacidades!
                    </p>
                </div>

                <hr class="separed-home" />

                <div class="cards-info-container">
                    <div class="card-info ">
                        <div class="card-info-body ">
                            <img src={{ asset('images/webpay.svg') }} alt="webpay" width="300" height="74"
                                class="card-info-image" />
                            <p class="card-info-text">El producto más usado para realizar un pago online. Se genera
                                un único cobro para todos los productos o servicios adquiridos por el tarjetahabiente
                                (carro de compras). </p>
                        </div>
                        <a href={{ route('webpay.create') }} class="card-info-link">
                            Ver ejemplos y modalidades
                        </a>
                    </div>

                    <div class="card-info ">
                        <div class="card-info-body ">
                            <img src={{ asset('images/oneclick.svg') }} alt="webpay" width="300" height="74"
                                class="card-info-image" />
                            <p class="card-info-text">Permite realizar pagos con un solo clic en un comercio habitual
                                para el tarjetahabiente, una vez que este haya registrado su tarjeta en el comercio.
                            </p>
                        </div>
                        <a href={{ route('oneclick-mall.start') }} class="card-info-link">
                            Ver ejemplos y modalidades
                        </a>
                    </div>
                </div>

                <hr class="separed-home" />

                @include('partials.channels')

            </div>
        </div>
        @include('partials.footer')
    </div>
    @stack('scripts')
</body>

</html>
