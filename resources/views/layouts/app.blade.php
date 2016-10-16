<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body class="container">

      @include('nav')

      @yield('content')
      {{-- <script type="text/javascript" src="/js/app.js"></script> --}}
  </body>
</html>
