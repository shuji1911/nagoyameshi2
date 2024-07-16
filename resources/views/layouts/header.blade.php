        <nav class="navbar navbar-expand-md navbar-light nagoyameshi-navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('/images/logo.png') }}" alt="ロゴ" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="{{ route('company') }}" class="nav-link">会社情報</a></li>
                        <!-- Authentication Links -->
                        @if (Auth::guard('admin')->check())
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        @else
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('mypage') }}">
                                        マイページ
                                    </a>
                                </li>
                            @endguest
                        @endif
                    </ul>
                </div>
            </div>
        </nav>