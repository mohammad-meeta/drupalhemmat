<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield("title", config('app.name'))</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main>
            @include('flash-message')
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    <script defer src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
