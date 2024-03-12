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
                    <i class="fa-solid fa-chart-simple fa-rotate-90"></i>
                    <a href="{{route('owner.home')}}">Rese Staff Only</a>
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
        </header>

        <main>
            @yield('content')
        </main>
    </body>

</html>