<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('browser-title')</title>
    <meta name="description" content="Yuk Iuran adalah aplikasi manajemen administrasi kos-kosan" />
    <meta name="generator" content="yuk iuran">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <meta property="og:image" name="twitter:image" content="http://bootstrap.themes.guide/assets/ss_greyson.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="github.com/H4fif">
    <meta name="twitter:creator" content="Hafif I.">
    <meta name="twitter:title" content="Yuk Iuran, aplikasi web, manajemen administrasi, kos-kosan">
    <meta name="twitter:description" content="Yuk Iuran, aplikasi web, manajemen administrasi, kos-kosan">
    <meta name="token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.min.css') . '?v=' . time() }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons-3.0.0.css') . '?v=' . time() }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') . '?v=' . time() }}" rel="stylesheet">
    <link href="{{ asset('css/template.css') . '?v=' . time() }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') . '?v=' . time() }}" rel="stylesheet">
  </head>

  <body data-spy="scroll" data-target="#navbar1" data-offset="60">
    @include('templates.header')

    <main>
      @yield('main-content')
    </main>

    @include('templates.footer')

    <script src="{{ asset('js/jquery-3.5.1.min.js') . '?v=' . time() }}"></script>
    <script src="{{ asset('js/popper-1.13.0.min.js') . '?v=' . time() }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') . '?v=' . time() }}"></script>
    <script src="{{ asset('js/scripts.js') . '?v=' . time() }}"></script>

    @yield('script')
  </body>
</html>