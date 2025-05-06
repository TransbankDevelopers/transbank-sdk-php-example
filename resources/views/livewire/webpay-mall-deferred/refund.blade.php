<div>
    <div class="tbk-card">
        <h3 class="tbk-card-title">transaction.refund()</h3>
        <form wire:submit.prevent="refund">
            <div class="input-container mb-32">
                <label for="token" class="tbk-label">Token</label>
                <input type="text" wire:model="token" name="token" class="tbk-input-text" required>
            </div>

            <div class="input-container mb-32">
                <label for="childCommerceCode" class="tbk-label">Código de Comercio Tienda</label>
                <input type="text" wire:model="childCommerceCode" name="childCommerceCode" class="tbk-input-text"
                    required>
            </div>

            <div class="input-container mb-32">
                <label for="buyOrder" class="tbk-label">Orden de Compra Tienda</label>
                <input type="text" wire:model="buyOrder" name="buyOrder" class="tbk-input-text" required>
            </div>

            <div class="input-container mb-32">
                <label for="amount" class="tbk-label">Monto</label>
                <input type="number" wire:model="amount" name="amount" class="tbk-input-text" required>
            </div>

            <div class="tbk-card-footer">
                <button class="tbk-button primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Reversar/Anular</span>
                    <span wire:loading>
                        Reversando/Anulando
                        <span class="spinner"></span>
                    </span>
                </button>
            </div>
        </form>

        @if ($refundResponse)
            <x-snippet :content="$refundResponse" />
        @endif
    </div>
</div>
