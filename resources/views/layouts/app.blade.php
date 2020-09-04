<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@yield('styles')

<!-- Scripts -->
    <script src="https://use.fontawesome.com/ab618c2ed4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"
            integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>


</head>
<body>
<div id="app" class="body-container">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm header-hr" >
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.jpg') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mx-auto nav-item-one">
                    <li class="nav-item active ">
                        <a class="nav-link" href={{route('index')}}>Главная</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href={{route('index')}}>Квартиры</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href={{route('index')}}>Объявления</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href={{route('index')}}>О нас</a>
                    </li>
                </ul>


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item sign-in-block">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fa fa-sign-in fa-3x" aria-hidden="true"></i>
                                <span class="sign-in my-auto ml-1">{{ __('Войти') }}</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="nav-user-avatar" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="">
                                    <span class="user-name">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
                                    <span class="ml-1">Личный кабинет</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                                    <span class="ml-1">{{ __('Выход') }}</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="">
        @yield('content')
    </main>

    <footer>
        <div class="main-row">
            <div class="container">
                <div class="row">
                    <div class="col-9 link-style my-auto">
                        <a href="{{ route('index') }}">Главная</a> • <a href="{{ route('about') }}">О нас</a> • <a
                            href="{{ route('flat-search') }}">Сдача жилья</a> • <a
                            href="{{ route('household-service-search') }}">Поиск хозработника</a> • <a
                            href="{{ route('login') }}">Вход</a> • <a href="{{ route('register') }}">Регистре</a>
                    </div>
                    <div class="col-3 text-white">
                        <div class="mb-1 mt-1">Техническая поддержка:</div>
                        <div class="mb-1"><i class="fa fa-phone" aria-hidden="true"></i> +7 (911) 000-00-00 </div>
                        <div class="mb-1"><i class="fa fa-envelope-o" aria-hidden="true"></i> support@varenduru.ru</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="secondary-row ">
            <div class="container">
                <div class="row">
                    <div class="text-white col-9">© «ВАРЕНДУРУ», 2020. Все права защищены</div>
                    <div class="text-white col-3 link-style"><a href="{{ route('rules') }}">Правила использования сервиса</a></div>
                </div>
            </div>
        </div>
    </footer>

</div>
</body>
</html>
