@php
    $navigation = ['confirm' => 'Confirmar transacción', 'other' => 'Ejemplo'];
@endphp

<x-layout active-link="Wepbay Plus" :navigation="$navigation">

    <h1 id="confirm">Webpay Plus - Confirmar transacción</h1>
    <p class="mb-32">En este paso es importante confirmar la transacción para notificar a Transbank que hemos recibido
        exitosamente los detalles de la transacción. Si la confirmación no se realiza, la transacción será reversada.
    </p>

    <h2>Paso 1 - Datos recibidos:</h2>
    <ul class="mb-32">
        <div class="m-32">Después de completar el flujo en el formulario de pago, recibirás un POST con la siguiente
            información:</div>
    </ul>
    <div class="mb-32"> @dump($resp)</div>

    <h2>Paso 2 - Petición:</h2>
    <p class="mb-32">
        Utilizarás el token recibido para confirmar la transacción mediante una nueva llamada a WebpayPlus.
    </p>

    <div class="mb-32">
        {{-- @dump($respond) --}}snippet
    </div>

    <h2>Paso 3 - Respuesta:</h2>
    <p class="mb-32">
        Transbank responderá con la siguiente información. Es crucial guardar esta respuesta, y la única
        validación necesaria es que el campo "response_code" sea igual a cero.
    </p>

    <div class="mb-32">
        snippet
    </div>

    <h2>¡Listo!</h2>
    <p class="mb-32">
        Con la confirmación exitosa, ya puedes mostrar al usuario una página de éxito de la transacción,
        proporcionándole la tranquilidad de que el proceso ha sido completado con éxito.
    </p>
    <p>
        Después de confirmar la transacción, podrás realizar otras operaciones útiles:
    <ul>
        <li>
            <span>Reembolsar:</span> Puedes reversar o anular el pago según ciertas condiciones comerciales.
        </li>
        <li>
            <span>Consultar Estado:</span> Hasta 7 días después de la transacción, podrás consultar el estado de la
            transacción.
        </li>
    </ul>
    </p>

    <div id="other" class="mb-32">
        Por último, con la respuesta del servicio que confirma la creación de la transacción, procedemos
        a crear el formulario de pago. Para fines de este ejemplo, haremos visible el campo "token_ws", el cual es
        esencial para completar el proceso de pago de manera exitosa.
    </div>

    <form action={{ route('webpay.refund') }} method="POST">
        @csrf
        <div class="tbk-card">
            <div class="input-container">
                <label for="amount" class="tbk-label">Monto a reembolsar:</label>
                <input type="text" name="amount" class="tbk-input-text" value={{ $resp->amount }}>
                <input type="hidden" name="token" class="tbk-input-text" value={{ $token }}>
            </div>
            <div class="tbk-card-footer ">
                <button class="tbk-button primary">REEMBOLSAR</button>
            </div>
        </div>
    </form>
    <a href={{ route('webpay.status', ['token' => $token]) }} class="tbk-button primary mb-32">CONSULTAR ESTADO</a>
</x-layout>
