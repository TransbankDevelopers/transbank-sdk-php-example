<div>
    <div class="tbk-card">
        <h3 class="tbk-card-title">transaction.captured()</h3>
        <form wire:submit.prevent="captureTransaction">
            <div class="input-container mb-32">
                <label for="childCommerceCode" class="tbk-label">Código de comercio hijo</label>
                <input type="text" wire:model="childCommerceCode" name="childCommerceCode" class="tbk-input-text"
                    required>
            </div>

            <div class="input-container mb-32">
                <label for="childBuyOrder" class="tbk-label">Orden de compra hijo</label>
                <input type="text" wire:model="childBuyOrder" name="childBuyOrder" class="tbk-input-text" required>
            </div>

            <div class="input-container mb-32">
                <label for="authorizationCode" class="tbk-label">Código de autorización</label>
                <input type="text" wire:model="authorizationCode" name="authorizationCode" class="tbk-input-text"
                    required>
            </div>

            <div class="input-container mb-32">
                <label for="amount" class="tbk-label">Monto a capturar</label>
                <input type="number" wire:model="amount" name="amount" class="tbk-input-text" required>
            </div>

            <div class="tbk-card-footer">
                <button class="tbk-button primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>CAPTURAR</span>
                    <span wire:loading>
                        CAPTURANDO
                        <span class="spinner"></span>
                    </span>
                </button>
            </div>
        </form>

        @if ($captureResponse)
            <x-snippet :content="$captureResponse" />
        @endif
    </div>
</div>
