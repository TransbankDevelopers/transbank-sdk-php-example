<button id="dark-mode" class="dark-mode-btn">
    <img src={{ asset('images/son.svg') }} alt="son" class="son-img">
    <img src={{ asset('images/moon.svg') }} alt="moon" class="moon-img">
</button>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('dark-mode').addEventListener('click', function() {
                const root = document.documentElement
                const currentTheme = root.getAttribute('data-theme')

                if (currentTheme === 'light') {
                    root.setAttribute('data-theme', 'dark')
                    root.classList.remove('light')
                    root.classList.add('dark')
                } else {
                    root.setAttribute('data-theme', 'light')
                    root.classList.remove('dark')
                    root.classList.add('light')
                }
            })
        });
    </script>
@endpush
