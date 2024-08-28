@php
    $navigation = ['create' => 'Crear transacción', 'example' => 'Ejemplo'];
@endphp

<x-layout active-link="Oneclick Mall" :navigation="$navigation">
    <h1 id="create">Oneclick Mall - Creación de transacción</h1>
    <p class="mb-32">
        En esta etapa comienza el proceso de inscripción del medio de pago. Este paso inicial es fundamental, para
        dirigir al tarjetahabiente al formulario de inscripción.
    </p>

    <h2>Paso 1: Petición</h2>
    <ul class="mb-32">
        <li>Comienza por importar la librería Oneclick en tu proyecto.</li>
        <li>Después podrás iniciar una inscripción.</li>
    </ul>
    <x-snippet>
        use Illuminate\Http\Request;
        use Transbank\Webpay\Options;
        use Transbank\Webpay\Oneclick\MallInscription;
        use Transbank\Webpay\Oneclick\MallTransaction;
        //configuración de la transacción
        $option = new Options(self::API_KEY, self::COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $mallInscription = new MallInscription($option);
        $mallTransaction = new MallTransaction($option);
        $resp = $mallInscription->start($startTx["userName"], $startTx["email"], $startTx["responseUrl"]);
    </x-snippet>

    <h2>Paso 2: Respuesta</h2>
    <p class="mb-32">
        Una vez que hayas iniciado la inscripción, aquí encontrarás los datos de respuesta generados por el proceso.
    </p>

    <x-snippet :content="$resp" />

    <h2>Paso 3: Creación del formulario</h2>
    <p class="mb-32">
        Utiliza estos datos de respuesta para generar y presentar un formulario de pago al Tarjetahabiente.
        Este formulario será la interfaz a través de la cual el usuario realizará su transacción.
    </p>

    <x-snippet>
        form action="https://webpay3gint.transbank.cl/webpayserver/initTransaction" method="POST">
        input type="hidden" name="token_ws" value="{{ $resp->token }}" />
        input type="submit" value="Pagar" />
        form>
    </x-snippet>

    <h2 id="example">Ejemplo</h2>
    <p class="mb-32">
        Para llevar a cabo una transacción de compra en nuestro sistema, primero debemos crear la
        transacción. Utilizaremos los siguientes datos para configurar la transacción:
    </p>

    <div class="mb-32">
        <x-table :request="$request" />
    </div>

    <p class="mb-32">
        Por último, con la respuesta del servicio que confirma la creación de la transacción, procedemos
        a crear el formulario de pago. Para fines de este ejemplo, haremos visible el campo "token_ws", el cual es
        esencial para completar el proceso de pago de manera exitosa.
    </p>

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
