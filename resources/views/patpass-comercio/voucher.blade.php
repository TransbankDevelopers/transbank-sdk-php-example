@php
    $navigation = ['form' => 'Formulario'];
@endphp

<x-layout active-link="Patpass Comercio" :navigation="$navigation">
    <div class="breadcrumbs-container">
        <div class="breadcrumbs-items">
            <a href="/">Inicio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a href="/patpass-comercio">Patpass Comercio</a>
            <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
        </div>
        <div class="breadcrumbs-items">
            <a class="current-breadcrumb" href="/patpass-comercio/voucher">Voucher</a>
        </div>
    </div>

    <h1>Patpass Comercio - Voucher</h1>
    <p class="mb-32">
        La inscripción ya se encuentra finalizada. Una vez finalizada la inscripción puedes seguir consultando por el
        voucher.
    </p>

    <div id="form" class="tbk-card">
        <span class="tbk-card-title">Voucher</span>
        <div class="input-container mb-32">
            <label for="tokenComercio" class="tbk-label">Token</label>
            <input type="text" id="tokenComercio" class="tbk-input-text" value="{{ $j_token }}" disabled>
        </div>
        <div class="tbk-card-footer">
            <form action="https://pagoautomaticocontarjetasint.transbank.cl/nuevo-ic-rest/tokenVoucherLogin"
                method="POST">
                <input type="hidden" name="tokenComercio" value="{{ $j_token }}">
                <button class="tbk-button primary">VER VOUCHER</button>
            </form>
        </div>
    </div>
</x-layout>
