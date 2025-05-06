@props(['label'])

<div class="mb-32" data-collapse>
    <button data-collapse-button class="cp-btn">
        {{ $label }}
        <span data-collapse-icon>▼</span>
    </button>

    <div data-collapse-content class="cp-container" style="max-height: 0; ">
        <div class="cp-content">
            {{ $slot }}
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const collapses = document.querySelectorAll('[data-collapse]');

                collapses.forEach(function(collapse) {
                    const button = collapse.querySelector('[data-collapse-button]');
                    const content = collapse.querySelector('[data-collapse-content]');
                    const icon = collapse.querySelector('[data-collapse-icon]');

                    button.addEventListener('click', function() {
                        if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                            content.style.maxHeight = '0px';
                            icon.textContent = '▼';
                        } else {
                            content.style.maxHeight = content.scrollHeight + 'px';
                            icon.textContent = '▲';
                        }
                    });
                });
            });
        </script>
    @endpush
@endonce
