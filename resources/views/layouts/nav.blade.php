<nav class="navbar navbar-expand-md">
    <div class="container">

        <input id="responsive-menu" type="checkbox">
        <label for="responsive-menu"><span id="menu-icon"></span></label>
        <div id="overlay" class="d-flex">
            <div class="menu-background"><img src="{{ asset('images/menu-background.jpg') }}"/></div>
            <div class="menu-links">
                <a href="/">خانه</a>
                <a href="/">ثبت نام</a>
                <a href="/">ورود</a>
                <a href="/">داشبورد</a>
                <a href="/">تماس با ما</a>
                <a href="/">درباره ما</a>
            </div>
            <div class="menu-links">
                <a href="/">همکاری درون بخشی</a>
                <a href="/">مشارکت مردم</a>
                <a href="/">همکاری بین بخشی</a>
                <a href="/">دیده بانی سلامت استان</a>
                <a href="/">رویدادها</a>
                <a href="/">مرکز اسناد راهبردی</a>
            </div>
        </div>

        <div class="nav-user-container d-flex">
            <div class="nav-user-container-icon d-flex justify-content-center">
                <img src="{{ asset('images/user.svg') }}">
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-2">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav mr-2">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('ورود') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('ثبت نام') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}">
        </a>

    </div>
</nav>
