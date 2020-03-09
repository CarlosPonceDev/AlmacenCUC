<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="sb-nav-fixed">

  @includeIf('include.navbar')
  
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      @includeIf('include.sidebar')
    </div>

    <div id="layoutSidenav_content">
      <main>
        <div class="container p-5">
          @yield('content')
        </div>
      </main>
      @includeIf('include.footer')
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/SBAdmin.js') }}" defer></script>
  @stack('inline-scripts')
</body>
</html>
