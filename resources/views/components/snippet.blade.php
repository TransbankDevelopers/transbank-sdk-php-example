@php
    $clipboard = $slot->isNotEmpty()
        ? preg_replace('/\n\s+/', "\n", $slot)
        : json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
@endphp
<div class="snippet-container">
    <button class="clipboard" data-clipboard-text="{{ $clipboard }}">
        <img src={{ asset('images/copy.svg') }} alt="copy">
    </button>
    <pre class="mb-32"><code>
{!! $clipboard !!}
    </code></pre>
</div>
