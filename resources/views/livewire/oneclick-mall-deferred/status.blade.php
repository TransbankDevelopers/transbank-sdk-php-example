<div>
    <div class="tbk-card">
        <h3 class="tbk-card-title">transaction.status()</h3>
        <form wire:submit.prevent="checkStatus">
            <div class="input-container mb-32">
                <label for="buyOrder" class="tbk-label">Orden de compra</label>
                <input type="text" wire:model="buyOrder" name="buyOrder" class="tbk-input-text" required>
            </div>

            <div class="tbk-card-footer">
                <button class="tbk-button primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>CONSULTAR ESTADO</span>
                    <span wire:loading>
                        CONSULTANDO
                        <span class="spinner"></span>
                    </span>
                </button>
            </div>
        </form>

        @if ($statusResponse)
            <x-snippet :content="$statusResponse" />
        @endif
    </div>
</div>
