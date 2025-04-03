@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('token-updated', (data) => {
            const snippetSpanList = document.querySelectorAll('.hljs-string');
            snippetSpanList.forEach(span => {
                if (span.textContent.includes(data.oldToken)) {
                    span.textContent = span.textContent.replace(data.oldToken, data.token);
                }
            });

        });
    });
</script>
@endpush
