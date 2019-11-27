<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles')

    <!-- Scripts -->
    <script defer src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')
</head>
<body>
    <div id="app">
        @include('layouts.nav')
        <main class="py-4">
            @include('flash-message')
            @yield('content')
        </main>
    </div>
</body>
</html>
