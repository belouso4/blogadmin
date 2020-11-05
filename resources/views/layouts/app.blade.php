<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">--}}

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{!! MetaTag::tag('description') !!}" />
    <meta name="keywords" content="{!! MetaTag::tag('keywords') !!}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! MetaTag::tag('title') !!}</title>

    <!-- Scripts -->

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('asset/css/main.css') }}">
{{--    <script src="{{ asset('asset/js/main.js') }}"></script>--}}
</head>
<body>
<header class="header">
    <div class="header-top">
        <div class="container d-flex justify-between align-center">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('asset/img/logo.png') }}" alt="">
            </a>
            @guest
            <form class="auth d-flex" name="auth" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="auth__input">
                    <input class="input" id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Логин">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input class="@error('password') is-invalid @enderror" class="input" name="password" type="password" placeholder="Пароль" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="auth__press">
                    <button class="d-flex" name="auth" type="submit" value="Войти">Войти</button>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Зарегистрироваться ?</a>
                    @endif

                </div>
            </form>
            <div class="auth-reestablish">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Забыли пароль?</a>
                    <a href="{{ route('password.request') }}">Забыли логин?</a>
                @endif
            </div>

            @if (Route::has('register'))
                <a class="registration" href="{{ route('register') }}">Зарегистрироваться ?</a>
            @endif
            @endguest
        </div>
    </div>
    <div class="header-center">
        <div class="container d-flex justify-between align-center">
            <nav class="nav">
                <div class="sandwich">
                    <div class="sandwich__line sandwich__line--top"></div>
                    <div class="sandwich__line sandwich__line--middle"></div>
                    <div class="sandwich__line sandwich__line--bottom"></div>
                </div>
                <ul id="nav" class="nav__wrap">
                    @guest
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="z-index: 2">
                                @if ( Auth::user()->isAdministrator())
                                    <a class="dropdown-item" href="{{ url('admin/home') }}">
                                        Войти в админку
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Выход
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <li>
                        <a href="{{ url('/') }}">
                            Главная
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Лента новостей
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Мой профиль
                        </a>
                    </li>
                    <li>
                        <a href="">
                           Тех поддержка
                        </a>
                    </li>
                    <li>
                        <a href="">
                            О блоге
                        </a>
                    </li>

                </ul>
            </nav>
            <form class="search" name="search" action="{{ url('search/result') }}" method="get" autocomplete="off">
                <input class="input"name="search" id="search" type="text" placeholder="Поиск">
                <button class="done" type="submit" value="">
                    <img src="{{ asset('asset/img/next.svg') }}" alt="">
                </button>
            </form>
        </div>
    </div>
@if (!empty($slider))
        <div class="header-main">
            <div class="container d-flex justify-between">
                <div class="content-img" style="text-align: center;">
                    <img style="max-height: 370px;width: auto;" src="{{ asset("/uploads/single/$slider->img") }}" alt="">
                </div>
                <div class="content-text">
                    <h2>
                        {{ $slider->title ?? '' }}
                    </h2>
                    <div>
                        {{ $slider->excerpt ?? '' }}
                    </div>
                    <a href="{{ route('blog.post.show', [$slider->category->alias, $slider->alias]) }}">Подробнее</a>
                </div>
            </div>
        </div>
@endif


</header>
<section class="main"> <aside></aside>
    <aside class="sidebar">
        @auth
        <div class="block">
            <div class="head-block">
                Панель пользователя
            </div>
            <div class="content">
                <p class="center">Здравствуйте,<br><b>{{ Auth::user()->name ?? '' }}</b>!</p>
                <p class="center">
                    <img src="{{ asset('asset/img/callback6.jpg') }}" alt="Кирилл" class="big_avatar">
                </p>
                <ul class="content-menu  padding-no">
                    <li>
                        <a class="active" href="editprofile.html">Редактировать профиль</a>
                    </li>
                    <li>
                        <a href="/user/editsubscribe.html">Управление подпиской</a>
                    </li>
                    <li>
                        <a href="/user/editsubscribeforum.html">Подписка на темы форума</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Выход
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endauth
        <div class="block">
            <div class="head-block">
                Статьи | новости
            </div>
            @if ($menu)
                <ul class="content-menu padding-no">

                    @include('layouts.menu', ['items' => $menu->roots()])

                </ul>
            @endif
        </div>
        <div class="block">
            <div class="head-block">
                Опрос
            </div>
            <div class="content-menu">
                <div id="poll">
                    <p>Какая модель телефона вам больше нравится?</p>
                    <form name="poll" action="/poll.html?id=2" method="post">
                        <div>
                            <input id="poll_data_9" type="radio" name="poll_data_id" value="9">
                            <label for="poll_data_9">Apple</label>
                        </div>
                        <div>
                            <input id="poll_data_10" type="radio" name="poll_data_id" value="10">
                            <label for="poll_data_10">Sumsung</label>
                        </div>
                        <div>
                            <input id="poll_data_11" type="radio" name="poll_data_id" value="11">
                            <label for="poll_data_11">Nokia</label>
                        </div>
                        <div>
                            <a href="poll-result.html">wwwww</a>
                            <input type="submit" name="poll" value="Голосовать" class="button">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!--------- content ---------->
    @yield('content')

</section>
<footer class="d-flex align-center">
    <p>	Copyright © 2010-2019 Белоусов Кирилл Олегович. Все права защищены.</p>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
{{--<script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}" ></script>--}}

<script src="{{ asset('asset/js/main.js') }}"></script>



</body>
</html>
