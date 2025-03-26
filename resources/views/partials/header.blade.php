<div class="tbk-header">
    <div class="tbk-header-left">
        <button class="tbk-buger-menu" id="burger-menu">
            <img src="{{ asset('images/menu.svg') }}" alt="tbk logo" width="{32}" height="{32}" />
        </button>
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/tbk-logo.svg') }}" alt="tbk logo" width="{181}" height="{34}"
                class="tbk-logo" />
        </a>
    </div>
    <div class="tbk-header-options">
        <a href="https://transbank.continuumhq.dev/slack_community" target="_blank" rel="noopener"
            class="tbk-button secondary"><span class="underline text-tbk-red">Comunidad Slack</span></a>
        <x-darkMode />
    </div>

    <x-mobileMenu />

</div>

@push('scripts')
    <script>
        const burgerMenu = document.getElementById('burger-menu');
        const mobileSdContainer = document.querySelector('.tbk-sidebar-mobile');
        const closeBtn = document.getElementById('close-sidebar-btn');
        console.log(closeBtn);
        burgerMenu.addEventListener('click', () => {
            mobileSdContainer.classList.toggle('show');
        });
        closeBtn.addEventListener('click', () => {
            mobileSdContainer.classList.remove('show');
        });
    </script>
@endpush
