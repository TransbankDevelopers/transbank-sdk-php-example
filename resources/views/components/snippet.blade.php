@php
    $clipboard = $slot->isNotEmpty()
        ? preg_replace('/\n\s+/', "\n", $slot)
        : json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
@endphp
<div class="snippet-container my-32">
    <button class="clipboard" data-clipboard-text="{{ $clipboard }}">
        <img src={{ asset('images/copy.svg') }} alt="copy">
    </button>
    <pre><code>
{!! $clipboard !!}
    </code></pre>
</div>
