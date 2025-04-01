@if (isset($navigation) && !empty($navigation))
    <div class="nav-container">
        <span class="nav-title">Contenido en esta página</span>
        <ul class="nav-list">
            @foreach ($navigation as $sectionId => $title)
                <li>
                    <a href="#{{ $sectionId }}" class="item">
                        {{ $title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var observer = new IntersectionObserver(entries => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        document.querySelectorAll('.nav-container .item').forEach(link => {
                            link.classList.remove('active');
                        });
                        document.querySelector('.nav-container .item[href="#' + entry.target.id +
                            '"]').classList.add('active');
                    }
                });
            }, {
                rootMargin: '0px 0px -70% 0px'
            });

            document.querySelectorAll('.nav-container .item').forEach(link => {
                observer.observe(document.querySelector(link.getAttribute('href')));
            });
        });
    </script>
@endpush
