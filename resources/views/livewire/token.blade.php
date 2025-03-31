<div class="input-container" wire:poll.{{ $pollInterval }}="updateToken">
    <label for={{ $tokenName }} class="tbk-label">Token</label>
    <input type="text" name={{ $tokenName }} class="tbk-input-text" value={{ $token }} required>
    <div class="tbk-info-token">
        <img src={{ asset('images/InfoBlue.svg') }} alt="info logo" class="tbk-info-token-icon">
        <p class="tbk-info-token-text text-tbk-black">El token generado en esta aplicación se renueva automáticamente cada 5 minutos.</p>
    </div>
</div>
