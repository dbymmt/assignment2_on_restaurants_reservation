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
        <header>
            <h1>
                <a href="#">Rese</a>
            </h1>
        </header>
    </body>
    <main>
        @yield('content')
    </main>

</html?