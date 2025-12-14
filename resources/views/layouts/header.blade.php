<header class="main-header">
    <div class="main-header__top">
        <div class="main-header__top-inner">
            <div class="main-header__top-left">
                <ul class="list-unstyled main-header__contact-list">
                    <li>
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="text">
                            <p><a href="mailto:{{ company()->email }}">{{ company()->email }}</a></p>
                        </div>
                    </li>
                    <li>
                        <div class="icon">
                            <i class="fas fa-map-marker"></i>
                        </div>
                        <div class="text">
                            <p>{{ company()->address }}</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="main-header__top-right">
                <div class="main-header__social-box">
                    {{-- <h4 class="main-header__social-title">Follow on:</h4> --}}
                    <div class="main-header__social">
                        @if (isset(auth()->user()->id))
                            <a href="/admin" class="text-warning"><i class="fa fa-sign-in-alt"></i>&nbsp;&nbsp; DASHBOARD
                            </a>
                        @else
                            <a href="/admin" class="text-warning"><i class="fa fa-sign-in-alt"></i>&nbsp;&nbsp; LOGIN
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-menu">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="/"><img src="{{ company()->image }}" alt="{{ company()->name }}"
                                style="width: 200px;"></a>
                    </div>
                    <livewire:layouts.navbar-menu />
                </div>
            </div>
        </div>
    </nav>
</header>
