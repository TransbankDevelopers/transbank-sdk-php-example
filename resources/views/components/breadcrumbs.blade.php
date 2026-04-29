@props(['items' => []])

<div class="breadcrumbs-container">
    @foreach ($items as $item)
        <div class="breadcrumbs-items">
            <a
                @class(['current-breadcrumb' => $item['current'] ?? false])
                href="{{ $item['href'] ?? '#' }}"
            >
                {{ $item['label'] }}
            </a>

            @if (!($item['current'] ?? false))
                <img src={{ asset('images/t-arrow.svg') }} alt="t-arrow" width="24" height="24" />
            @endif
        </div>
    @endforeach
</div>
