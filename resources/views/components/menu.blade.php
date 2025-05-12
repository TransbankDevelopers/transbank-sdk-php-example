<aside class="tbk-sidebar" id="sidebar-desk">
    <div class="toogle-btn-container">
        <button class="tbk-toggle-btn" id="toggle-sidebar-btn">
            &lt;
        </button>
    </div>

    <nav class="sidebar-content" id="sidebar-content">
        <div>
            <p class="tbk-sidebar-item-title">Webpay Plus</p>
            <ul>
                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="webpay-plus">
                        <span class="general-text">Webpay Plus</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24" />
                    </button>
                    <ul class="collapsible-content" id="collapse-webpay-plus">
                        <li class="collapsible-items">
                            <a href={{ route('webpay.create', [], false) }} class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        <li class="collapsible-items">
                            <a href={{ route('webpay.api-operations', parameters: [], absolute: false) }}
                                class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li>
                    </ul>
                </li>

                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="webpay-plus-mall">
                        <span class="general-text">Webpay Plus Mall</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24" />
                    </button>
                    <ul class="collapsible-content" id="collapse-webpay-plus-mall">
                        <li class="collapsible-items">
                            <a href={{ route('webpay-mall.create', [], false) }} class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        <li class="collapsible-items">
                            <a href={{ route('webpay-mall.api-operations', parameters: [], absolute: false) }}
                                class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li>
                    </ul>
                </li>

                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="webpay-plus-deferred">
                        <span class="general-text">Webpay Plus Diferido</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24" />
                    </button>
                    <ul class="collapsible-content" id="collapse-webpay-plus-deferred">
                        <li class="collapsible-items">
                            <a href={{ route('webpay-deferred.create', [], false) }} class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        <li class="collapsible-items">
                            <a href={{ route('webpay-deferred.api-operations', [], false) }} class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li>
                    </ul>
                </li>

                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="webpay-mall-diferido">
                        <span class="general-text">Webpay Plus Mall Diferido</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24" />
                    </button>
                    <ul class="collapsible-content" id="collapse-webpay-mall-diferido">
                        <li class="collapsible-items">
                            <a href={{ route('webpay-mall-deferred.create', [], false) }} class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        <li class="collapsible-items">
                            <a href={{ route('webpay-mall-deferred.api-operations', [], false) }}
                                class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <hr class="sidebar-divider" />
        </div>

        <div>
            <p class="tbk-sidebar-item-title">Webpay Oneclick</p>
            <ul>

                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="oneclick-mall">
                        <span class="general-text">Oneclick Mall</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24" />
                    </button>
                    <ul class="collapsible-content" id="collapse-oneclick-mall">
                        <li class="collapsible-items">
                            <a href={{ route('oneclick-mall.start', [], false) }} class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        {{-- <li class="collapsible-items">
                            <a href="/api-reference/oneclick-mall" class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li> --}}
                    </ul>
                </li>


                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="oneclick-mall-deferred">
                        <span class="general-text">Oneclick Mall Diferido</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24" />
                    </button>
                    <ul class="collapsible-content" id="collapse-oneclick-mall-deferred">
                        <li class="collapsible-items">
                            <a href={{ route('oneclick-mall-deferred.start', [], false) }} class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        {{-- <li class="collapsible-items">
                            <a href="/api-reference/oneclick-mall-deferred" class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li> --}}
                    </ul>
                </li>
            </ul>
            <hr class="sidebar-divider" />
        </div>

        <!-- ======================================================
           SECCIÓN 3: WEBPAY TRANSACCION COMPLETA
           ====================================================== -->
        {{-- <div>
            <p class="tbk-sidebar-item-title">Webpay transaccion completa</p>
            <ul>
                <!-- COLLAPSIBLE 1 -->
                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="transaccion-completa">
                        <span class="general-text">Transaccion Completa</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24"   />
                    </button>
                    <ul class="collapsible-content" id="collapse-transaccion-completa">
                        <li class="collapsible-items">
                            <a href="/transaccion-completa" class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        <li class="collapsible-items">
                            <a href="/api-reference/transaccion-completa" class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- COLLAPSIBLE 2 -->
                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="transaccion-completa-mall">
                        <span class="general-text">Transaccion Completa Mall</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24"   />
                    </button>
                    <ul class="collapsible-content" id="collapse-transaccion-completa-mall">
                        <li class="collapsible-items">
                            <a href="/transaccion-completa-mall" class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        <li class="collapsible-items">
                            <a href="/api-reference/transaccion-completa-mall" class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- COLLAPSIBLE 3 -->
                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="transaccion-completa-diferido">
                        <span class="general-text">Transaccion Completa Diferido</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24"   />
                    </button>
                    <ul class="collapsible-content" id="collapse-transaccion-completa-diferido">
                        <li class="collapsible-items">
                            <a href="/transaccion-completa-diferido" class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        <li class="collapsible-items">
                            <a href="/api-reference/transaccion-completa-diferido" class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- COLLAPSIBLE 4 -->
                <li style="margin-bottom:20px;">
                    <button class="sidebar-collapsible-title" data-collapsible="transaccion-completa-mall-diferido">
                        <span class="general-text">Transaccion Completa Mall Diferido</span>
                        <img src={{ asset('images/t-arrow.svg') }} class="arrow" alt="t-arrow" width="24"
                            height="24"   />
                    </button>
                    <ul class="collapsible-content" id="collapse-transaccion-completa-mall-diferido">
                        <li class="collapsible-items">
                            <a href="/transaccion-completa-mall-diferido" class="tbk-sidebar-item">
                                Flujo Completo
                            </a>
                        </li>
                        <li class="collapsible-items">
                            <a href="/api-reference/transaccion-completa-mall-diferido" class="tbk-sidebar-item">
                                Operaciones API
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <hr class="sidebar-divider" />
        </div> --}}

        <!-- ======================================================
           SECCIÓN 4: PATPASS
           ====================================================== -->
        {{-- <div>
            <p class="tbk-sidebar-item-title">Patpass</p>
            <ul>
                <li class="collapsible-items">
                    <a href="/patpass-comercio" class="tbk-sidebar-item general-text">
                        Flujo Completo
                    </a>
                </li>
            </ul>
            <hr class="sidebar-divider" />
        </div> --}}
    </nav>
</aside>

@push('scripts')
    <script>
        const toggleBtn = document.getElementById('toggle-sidebar-btn');
        const sidebar = document.getElementById('sidebar-desk');
        const bodyContainer = document.querySelector('.body-container');

        let isMenuVisible = true;
        toggleBtn.addEventListener('click', () => {
            isMenuVisible = !isMenuVisible;
            if (!isMenuVisible) {
                sidebar.classList.add("tbk-sidebar-hide");
                bodyContainer.classList.add("hide-sd");
            } else {
                sidebar.classList.remove("tbk-sidebar-hide");
                bodyContainer.classList.remove("hide-sd");
            }
        });


        const collapsibleTitles = document.querySelectorAll('.sidebar-collapsible-title');
        collapsibleTitles.forEach(title => {
            title.addEventListener('click', () => {
                const content = title.nextElementSibling;
                const arrow = title.querySelector('.arrow');
                if (!content) return;

                content.classList.toggle('open');
                arrow.classList.toggle('sidebar-icons-rotate');
            });
        });

        (function highlightActiveByUrl() {
            const currentPath = window.location.pathname;

            document.querySelectorAll("li.collapsible-items > a").forEach((anchor) => {
                const linkPath = anchor.getAttribute("href") || "";

                if (currentPath === linkPath) {
                    const liItem = anchor.parentElement;
                    liItem.classList.add("active");

                    const collapsibleUl = liItem.closest(".collapsible-content");
                    if (collapsibleUl) {
                        collapsibleUl.classList.add("open");

                        const collapsibleButton = collapsibleUl.previousElementSibling;
                        if (collapsibleButton) {
                            const icon = collapsibleButton.querySelector("img");
                            if (icon) icon.classList.add("sidebar-icons-rotate");
                        }
                    }
                }
            });
        })();
    </script>
@endpush
