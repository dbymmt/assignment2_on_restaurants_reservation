<!DOCTYPE html>
<html? lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <script src="{{ asset('js/script.js') }}"></script>

  @yield('css')
</head>
    <body>
        <header class="header">
            <div class="header__logo">
                <h1 class="header__logo">
                    <a href="#">Rese</a>
                </h1>
            </div>
            @if(request()->path() === "/")
            <div class="header__search-menu">
                <select name="area">
                    <option value="">All Areas</option>
                    <option value="1">北海道</option>
                </select>
                <select name="genre">
                    <option value="">All Genres</option>
                    <option value="1">寿司</option>
                </select>
                <input type="text" name="keyword" placeholder="Input restaurant name">
            </div>
            @endif
        </header>

        {{-- ホームメニュー --}}
        <nav class="header__nav">
            <ul class="header__menu">
                <li class="header__list"><a href="/">Home</a></li>
                <li class="header__list"><a href="/register">Registration</a></li>
                <li class="header__list"><a href="/login">Login</a></li>
            </ul>
        </nav>
        <main>
            @yield('content')
        </main>
    </body>

</html?