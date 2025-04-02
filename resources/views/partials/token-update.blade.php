@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('token-updated', (data) => {
            const spanList = document.querySelectorAll('.hljs-string');
            spanList.forEach(span => {
                if (span.textContent.includes(data.oldToken)) {
                    span.textContent = span.textContent.replace(data.oldToken, data.token);
                }
            });

        });
    });
</script>
@endpush
