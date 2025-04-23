<div>
    <div class="tbk-card">
        <h3 class="tbk-card-title">transaction.refund()</h3>
        <form wire:submit.prevent="refund">
            <div class="input-container mb-32">
                <label for="token" class="tbk-label">Token</label>
                <input type="text" wire:model="token" name="token" class="tbk-input-text" required>
            </div>

            <div class="input-container">
                <label for="amount" class="tbk-label">Monto</label>
                <input type="number" wire:model="amount" name="amount" class="tbk-input-text" required>
            </div>

            <div class="tbk-card-footer">
                <button class="tbk-button primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Refund</span>
                    <span wire:loading>
                        Refund
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
