<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>

    {{-- axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')

    <script src="{{ asset('js/script.js') }}"></script>
    @yield('js')

</head>
    <body>
        <header class="header">
            <div class="header__logo">
                <h1 id="header__menu-open">
                    <i class="fa-solid fa-chart-simple fa-rotate-90"></i>Rese Staff Only
                </h1>
            </div>

            <nav class="header-staff__menu">
                @if(Auth::check() && Auth::guard('admin')->check() && request()->is('*admin*'))
                <form action="{{route('admin.logout')}}" method="post">
                    @csrf
                    <input type="submit" value="logout">
                </form>
                @elseif(Auth::check() && Auth::guard('owner')->check() && request()->is('*owner*'))
                <form action="{{route('owner.logout')}}" method="post">
                    @csrf
                    <input type="submit" value="logout">
                </form>
                @endif
            </nav>
            {{-- @if(request()->path() === "/")
            <div class="header__search-menu">
                <select name="area" id="header__search-area">
                    <option value="">All Areas</option>
                    @foreach($areas as $area)
                        <option value="{{$area->id}}">{{$area->name}}</option>
                    @endforeach
                </select>
                <select name="genre" id="header__search-genre">
                    <option value="">All Genres</option>
                    @foreach($genres as $genre)
                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
                <input type="text" name="keyword" id="header__search-keyword" placeholder="Input restaurant name">
            </div>
            @endif --}}
        </header>

        {{-- ホームメニュー --}}
        {{-- <nav id="header__nav">
            <h1 id="header__menu-close">
                <i class="fa-solid fa-square-xmark"></i>
            </h1>
            <ul class="header__menu">
                <li class="header__list"><a href="/">Home</a></li>
                @if(Auth::check())
                    <li class="header__list">
                        <form action="{{route('user.logout')}}" name="logout" method="POST">
                            @csrf
                            <a href="javascript:logout.submit()">logout</a>
                        </form>
                    </li>
                    <li class="header__list"><a href="/mypage">Mypage</a></li>
                @else
                    <li class="header__list"><a href="/register">Registration</a></li>
                    <li class="header__list"><a href="/login">Login</a></li>
                @endif
            </ul>
        </nav> --}}
        <main>
            @yield('content')
        </main>
    </body>

</html>