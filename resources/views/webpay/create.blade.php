@php
    $navigation = ['create' => 'Crear transacción', 'example' => 'Ejemplo'];
@endphp

<x-layout active-link="Webpay Plus" :navigation="$navigation">
    <h1 id="create">Webpay Plus - Creación de transacción</h1>
    <p class="mb-32">En esta etapa, se procederá a la creación de una transacción con el fin de obtener un identificador
        único. Esto
        nos permitirá redirigir al Tarjetahabiente hacia el formulario de pago en el siguiente paso.
    </p>

    <h2>Paso 1: Petición</h2>
    <ul class="mb-32">
        <li>Comienza por importar la librería WebpayPlus en tu proyecto.</li>
        <li>Luego, crea una transacción utilizando las funciones proporcionadas por WebpayPlus.</li>
    </ul>
    <x-snippet>
        use Transbank\Webpay\WebpayPlus\Transaction;
        use Transbank\Webpay\Options;
        //configuración de la transacción
        $option = new Options(API_KEY, COMMERCE_CODE, Options::ENVIRONMENT_INTEGRATION);
        $transaction = new Transaction($option);
        $transaction->create($buyOrder, $sessionId, $amount, $returnUrl);
    </x-snippet>

    <h2>Paso 2: Respuesta</h2>
    <p class="mb-32">Una vez que hayas creado la transacción, aquí encontrarás los datos de respuesta generados por el
        proceso.
    </p>

    <x-snippet :content="$respond" />

    <h2>Paso 3: Creación del formulario</h2>
    <p class="mb-32">Utiliza estos datos de respuesta para generar y presentar un formulario de pago al Tarjetahabiente.
        Este formulario será la interfaz a través de la cual el usuario realizará su transacción.
    </p>

    <x-snippet>
        form action="https://webpay3gint.transbank.cl/webpayserver/initTransaction" method="POST">
        input type="hidden" name="token_ws" value="{{ $respond->token }}" />
        input type="submit" value="Pagar" />
        form>
    </x-snippet>

    <h2 id="example">Ejemplo</h2>
    <p class="mb-32">Para llevar a cabo una transacción de compra en nuestro sistema, primero debemos crear la
        transacción. Utilizaremos los siguientes datos para configurar la transacción:
    </p>

    <div class="mb-32">
        <x-table :request="$request" />
    </div>

    <p class="mb-32">Por último, con la respuesta del servicio que confirma la creación de la transacción, procedemos
        a crear el formulario de pago. Para fines de este ejemplo, haremos visible el campo "token_ws", el cual es
        esencial para completar el proceso de pago de manera exitosa.
    </p>

    <form action={{ $respond->url }} action="POST">
        <div class="tbk-card">
            <span class="tbk-card-title">Formulario de redirección</span>
            <div class="input-container">
                <label for="tokew_ws" class="tbk-label">Token</label>
                <input type="text" name="token_ws" class="tbk-input-text" value={{ $respond->token }} required>
            </div>
            <div class="tbk-card-footer">
                <button class="tbk-button primary">PAGAR</button>
            </div>
        </div>
    </form>
</x-layout>
