<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>COACHTECH</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  @yield('css')

</head>


<body>
  <header class=header>
    <a href="{{ route('index') }}">
    <img src="{{ asset('css/img/logo.svg') }}" alt="Logo" class="header__logo">
  </a>
  @if (Request::is('login') || Request::is('register'))
  @else
    @auth
        <form class="form" action="{{ route('search') }}" method="get">
        @csrf
          <input type="text"  name="query" class="search-form" placeholder="何をお探しですか" value="{{request('query')}}">
        </form>

        <form class="form" action="/logout" method="post">
        @csrf
          <button class="header-nav__button">ログアウト</button>
        </form>

        <form class="form" action="{{ route ('mypage') }}" method="get">
        @csrf
          <button class="header-nav__button">マイページ</button>
        </form>
  
        <form class="header-nav__sell" action="{{ route('sell') }}" method="GET">
          <button type="submit" class="header__button-sell">出品</button>
        </form>

    @else
        <form class="form" action="{{ route('search') }}" method="get">
        @csrf
          <input type="text"  name="query" class="search-form" placeholder="何をお探しですか" value="{{request('query')}}">
        </form>

        <form class="form" action="/login" method="get">
        @csrf
          <button class="header-nav__button">ログイン</button>
        </form>

        <form class="form" action="/" method="">
        @csrf
          <a link="" class="header-nav__mypage">マイページ</a>
        </form>
          {{-- <div class="header-nav__sell">
            <button class="header__button-sell" type="button" onclick="location.href='/'sell">出品</button>
          </div> --}}
          <form action="{{ route('sell') }}" method="GET">
            <button type="submit" class="header__button-sell">出品</button>
          </form>
    @endauth
  @endif

        @yield('link')
    </header>

      <div class="content">
        @yield('content')
  </div>
  </body>
  </html>