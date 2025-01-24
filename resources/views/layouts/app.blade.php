<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MathStar</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
<body class="{{ Route::currentRouteName() }} {{ request()->is('games/*') ? 'games' : '' }}
            {{auth()->check()&&auth()->user()->role==='teacher' ? 'teacher-role':''}}"
            style="background-image: url('/svg/bg.svg');">
    <div id="app" class="d-flex flex-column min-vh-100">
        <!-- header -->
        @include('layouts.header')
        
        <main class="flex-fill py-4">  

        <div id="fade-container">
        @yield('content')
        </div>   
        </main>

        @if(Route::currentRouteName() === 'home')
            @include('layouts.homep')
        @endif 

        <!-- Footer -->
        @include('layouts.footer')

    </div>
    @stack('scripts')
</body>
</html>


