<div>
    <div class="tbk-card">
        <h3 class="tbk-card-title">transaction.status()</h3>
        <form wire:submit.prevent="checkStatus">
            <div class="input-container">
                <label for="token" class="tbk-label">Token</label>
                <input type="text" wire:model="token" name="token" class="tbk-input-text" required>
            </div>

            <div class="tbk-card-footer">
                <button class="tbk-button primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Consultar Estado</span>
                    <span wire:loading>
                        Consultando Estado
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
