<x-layout active-link="">
    <h1>Se ha producido un error</h1>
    <p class="mb-32">Cuando se procesaba la operación, la API encontró un problema y devolvió un error.</p>

    <h1>¿Por qué no fue posible realizar la operación?</h1>
    <p class="mb-32">Cuando ocurre un error en la operación con la API, el SDK lo captura automáticamente. A
        continuación, se muestra el detalle de la excepción, lo que te permitirá identificar y comprender el problema.
    </p>

    <x-snippet>{{ $error }}</x-snippet>
</x-layout>
