<div>
    <div class="tbk-card">
        <h3 class="tbk-card-title">transaction.authorize()</h3>
        <form wire:submit.prevent="authorizeTransaction">
            <div class="input-container mb-32">
                <label for="tbkUser" class="tbk-label">Usuario TBK</label>
                <input type="text" wire:model="tbkUser" name="tbkUser" class="tbk-input-text" required>
            </div>

            <div class="input-container mb-32">
                <label for="userName" class="tbk-label">Nombre de usuario</label>
                <input type="text" wire:model="userName" name="userName" class="tbk-input-text" required>
            </div>
            <div class="input-container mb-32">
                <label for="buyOrder" class="tbk-label">Orden de compra mall
                </label>
                <input type="text" wire:model="buyOrder" name="buyOrder" class="tbk-input-text" required>
            </div>

            <!-- Tienda 1 -->
            <div class="tbk-section mb-32">
                <h4 class="tbk-section-title">Tienda 1</h4>
                <div class="tbk-input-group">
                    <div class="input-container mb-32">
                        <label for="commerceCode1" class="tbk-label">Código de comercio tienda</label>
                        <input type="text" wire:model="commerceCode1" name="commerceCode1" class="tbk-input-text"
                            required>
                    </div>

                    <div class="input-container mb-32">
                        <label for="buyOrder1" class="tbk-label">Orden de compra tienda</label>
                        <input type="text" wire:model="buyOrder1" name="buyOrder1" class="tbk-input-text" required>
                    </div>
                </div>
                <div class="tbk-input-group">
                    <div class="input-container mb-32">
                        <label for="amount1" class="tbk-label">Monto</label>
                        <input type="number" wire:model="amount1" name="amount1" class="tbk-input-text" required>
                    </div>

                    <div class="input-container mb-32">
                        <label for="installments1" class="tbk-label">Número de cuotas</label>
                        <input type="number" wire:model="installments1" name="installments1" class="tbk-input-text"
                            required>
                    </div>
                </div>
            </div>

            <!-- Tienda 2 -->
            <div class="tbk-section mb-32" x-data="{ show: false }">
                <div x-show="show">
                    <h4 class="tbk-section-title">Tienda 2</h4>
                    <div class="tbk-input-group">
                        <div class="input-container mb-32">
                            <label for="commerceCode2" class="tbk-label">Código de comercio tienda</label>
                            <input type="text" wire:model="commerceCode2" name="commerceCode2"
                                class="tbk-input-text">
                        </div>

                        <div class="input-container mb-32">
                            <label for="buyOrder2" class="tbk-label">Orden de compra tienda</label>
                            <input type="text" wire:model="buyOrder2" name="buyOrder2" class="tbk-input-text">
                        </div>
                    </div>

                    <div class="tbk-input-group">
                        <div class="input-container mb-32">
                            <label for="amount2" class="tbk-label">Monto</label>
                            <input type="number" wire:model="amount2" name="amount2" class="tbk-input-text">
                        </div>

                        <div class="input-container mb-32">
                            <label for="installments2" class="tbk-label">Número de cuotas</label>
                            <input type="number" wire:model="installments2" name="installments2"
                                class="tbk-input-text">
                        </div>
                    </div>
                </div>
                <div class="tbk-section-header">

                    <button type="button" class="tbk-link" @click="show = !show">
                        <span x-show="!show">Agregar tienda</span>
                        <span x-show="show">Quitar tienda</span>
                    </button>
                </div>
            </div>

            <div class="tbk-card-footer">
                <button class="tbk-button primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Autorizar</span>
                    <span wire:loading>
                        Autorizando
                        <span class="spinner"></span>
                    </span>
                </button>
            </div>
        </form>

        @if ($authorizeResponse)
            <x-snippet :content="$authorizeResponse" />
        @endif
    </div>
</div>
