<div class="tbk-menu">
    <div class="tbk-menu-item-container">
        <span class="tbk-menu-item-text">Webpay Plus</span>
        @foreach ([
        'Webpay Plus' => route('webpay.create'),
        'Webpay Plus Diferido' => route('webpay-deferred.create'),
        'Webpay Mall' => route('webpay-mall.create'),
        'Webpay Mall Diferido' => route('webpay-mall-deferred.create'),
        ] as $menuItemName => $url)
        <a href="{{ $url }}" class="tbk-menu-item {{ $activeLink == $menuItemName ? 'active' : '' }}">
            {{ $menuItemName }}
        </a>
        @endforeach
    </div>

    <div class="tbk-menu-item-container">
        <span class="tbk-menu-item-text">Webpay Oneclick</span>
        @foreach ([
        'Oneclick Mall' => route('oneclick-mall.start'),
        'Oneclick Mall Diferido' => route('oneclick-mall-deferred.start'),
        ] as $menuItemName => $url)
        <a href="{{ $url }}" class="tbk-menu-item {{ $activeLink == $menuItemName ? 'active' : '' }}">
            {{ $menuItemName }}
        </a>
        @endforeach
    </div>
</div>
