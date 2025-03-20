@php
$navigation = ['request' => 'Petición', 'response' => 'Respuesta', 'form' => 'Formulario', 'example' => 'Ejemplo'];
@endphp

<x-layout active-link="Oneclick Mall Diferido" :navigation="$navigation">
    <h1>Oneclick Mall Diferido - Creación de transacción</h1>
    <p class="mb-32">
        En esta etapa comienza el proceso de inscripción del medio de pago. Este paso inicial es fundamental, para
        dirigir al tarjetahabiente al formulario de inscripción.
    </p>
    <p>Todas las transacciones en este proyecto de ejemplo son realizadas en ambiente de integración.</p>

    <h2 id="request">Paso 1: Petición</h2>
    <ul class="mb-32">
        <li>Comienza por importar la librería Oneclick en tu proyecto.</li>
        <li>Después podrás iniciar una inscripción.</li>
    </ul>
    <x-snippet>
        use Transbank\Webpay\Options;
        use Transbank\Webpay\Oneclick\MallInscription;
        use Transbank\Webpay\Oneclick\MallTransaction;
        //configuración de la transacción
        $option = new Options(self::API_KEY, self::COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $mallInscription = new MallInscription($option);
        $resp = $mallInscription->start($startTx["userName"], $startTx["email"], $startTx["responseUrl"]);
    </x-snippet>

    <h2 id="response">Paso 2: Respuesta</h2>
    <p class="mb-32">
        Una vez que hayas iniciado la inscripción, aquí encontrarás los datos de respuesta generados por el proceso.
    </p>

    <x-snippet :content="$resp" />

    <h2 id="form">Paso 3: Creación del formulario</h2>
    <p class="mb-32">
        Utiliza estos datos de respuesta para generar y presentar un formulario de Inscripción al Tarjetahabiente.
    </p>

    <x-snippet>
        form action="https://webpay3gint.transbank.cl/webpayserver/initTransaction" method="POST">
        input type="hidden" name="TBK_TOKEN" value="{{ $resp->token }}" />
        input type="submit" value="Inscribir" />
        form>
    </x-snippet>

    <h2 id="example">Ejemplo</h2>
    <p class="mb-32">
        Para llevar a cabo una Inscripción en nuestro sistema, primero debemos crearla. Utilizaremos los siguientes
        datos para configurar la inscripción:
    </p>

    <div class="mb-32">
        <x-table :request="$request" />
    </div>

    <p class="mb-32">
        Por último, con la respuesta del servicio que confirma la creación de la transacción, procedemos
        a crear el formulario de pago. Para fines de este ejemplo, haremos visible el campo "TBK_TOKEN", el cual es
        esencial para completar el proceso de pago de manera exitosa.
    </p>
    <span>Antes de continuar al formulario de Webpay, asegúrate de contar con los datos de las tarjetas de prueba que están en la <a href="https://transbankdevelopers.cl/documentacion/como_empezar#tarjetas-de-prueba" class="tbk-link">documentación.</a></span>

    <form action={{ $resp->urlWebpay }} method="POST">
        <div class="tbk-card">
            <span class="tbk-card-title">Formulario de redirección</span>
            <div class="input-container">
                <label for="tokew_ws" class="tbk-label">Token</label>
                <input type="text" name="TBK_TOKEN" class="tbk-input-text" value={{ $resp->token }} required>
            </div>
            <div class="tbk-card-footer">
                <button class="tbk-button primary">INSCRIBIR</button>
            </div>
        </div>
    </form>
</x-layout>
