<button id="dark-mode" class="dark-mode-btn">
    <img src={{ asset('images/sun.svg') }} alt="sun" class="sun-img">
    <img src={{ asset('images/moon.svg') }} alt="moon" class="moon-img">
</button>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const theme = localStorage.getItem("theme");
            if (theme === "dark") {
                const root = document.documentElement
                root.setAttribute('data-theme', 'dark')
                root.classList.remove('light')
                root.classList.add('dark')
                localStorage.setItem("theme", "dark")
            }

            function setTheme() {
                const theme = localStorage.getItem("theme");
                const root = document.documentElement
                if (theme === "dark") {
                    root.setAttribute('data-theme', 'light')
                    root.classList.remove('dark')
                    root.classList.add('light')
                    localStorage.setItem("theme", "light")
                } else {
                    root.setAttribute('data-theme', 'dark')
                    root.classList.remove('light')
                    root.classList.add('dark')
                    localStorage.setItem("theme", "dark")
                }
            }



            document.getElementById('dark-mode').addEventListener('click', function() {
                setTheme()
            })
        });
    </script>
@endpush
