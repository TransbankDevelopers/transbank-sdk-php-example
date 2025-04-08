@props(['tabulate' => false, 'content' => ''])

@php
$clipboard = '';
if($slot->isNotEmpty()){
    if($tabulate){
        $lines = preg_split('/\r\n|\r|\n/', $slot);
        $lastIndex = count($lines) - 1;
        $spacesToRemove = strspn($lines[$lastIndex], " ");
        $clipboard = preg_replace('/^ {' .$spacesToRemove. '}/m', '',$slot);
    } else {
        $clipboard = preg_replace('/\n\s+/', "\n", $slot);
    }
} else {
    $clipboard = json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
@endphp
<div class="snippet-container">
    <button class="clipboard" data-clipboard-text="{{ $clipboard }}">
        <img src={{ asset('images/copy.svg') }} alt="copy">
    </button>
    <pre class="mb-32"><code>
{{ $clipboard }}
    </code></pre>
</div>
