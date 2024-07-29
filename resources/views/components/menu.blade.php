<div class="tbk-menu">
    <div class="tbk-menu-item-container">
        <span class="tbk-menu-item-text">Webpay Plus</span>
        @foreach ([
        'Wepbay Plus' => route('webpay.create'),
        'Wepbay Plus Diferido' => route('webpay.create'),
        'Wepbay Mall' => route('webpay-mall.create'),
        'Wepbay Mall Diferido' => route('webpay.create'),
    ] as $menuItemName => $url)
            <a href="{{ $url }}" class="tbk-menu-item {{ $activeLink == $menuItemName ? 'active' : '' }}">
                {{ $menuItemName }}
            </a>
        @endforeach
    </div>

    <div class="tbk-menu-item-container">
        <span class="tbk-menu-item-text">Webpay Oneclick</span>
        @foreach ([
        'Oneclick Mall' => route('webpay.create'),
        'Oneclick Mall Diferido' => route('webpay.create'),
    ] as $menuItemName => $url)
            <a href="{{ $url }}" class="tbk-menu-item {{ $activeLink == $menuItemName ? 'active' : '' }}">
                {{ $menuItemName }}
            </a>
        @endforeach
    </div>

    <div class="tbk-menu-item-container">
        <span class="tbk-menu-item-text">Webpay Transacción Completa</span>
        @foreach ([
        'Transacción Completa' => route('webpay.create'),
        'Transacción Completa Diferido' => route('webpay.create'),
        'Transacción Completa Mall' => route('webpay.create'),
        'Transacción Completa Mall Diferido' => route('webpay.create'),
    ] as $menuItemName => $url)
            <a href="{{ $url }}" class="tbk-menu-item {{ $activeLink == $menuItemName ? 'active' : '' }}">
                {{ $menuItemName }}
            </a>
        @endforeach
    </div>

    <div class="tbk-menu-item-container">
        <span class="tbk-menu-item-text">PatPass Comercio</span>
        <a href={{ route('webpay.create') }}
            class="tbk-menu-item {{ $activeLink == 'PatPass Comercio' ? 'active' : '' }}">
            PatPass Comercio
        </a>

    </div>


</div>
