@extends('layouts.app')

@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('unity/game/TemplateData/style.css') }}">
    <script src="{{ asset('unity/game1/TemplateData/UnityProgress.js') }}"></script>  
    <script src="{{ asset('unity/game1/Build/UnityLoader.js') }}"></script>
    <script>
       var gameInstance = UnityLoader.instantiate("gameContainer", "{{ asset('unity/game1/Build/sample game.json') }}", {onProgress: UnityProgress});
    </script>
</head>

<div class="games-page">
    <h1>Game 1 - Brick Game</h1>

    <div class="thegame">
        <!-- Unity Game Section -->
        <div class="game-container">
            <div id="gameContainer"></div>
        </div>

        <!-- Leaderboard Section -->
        <div class="leaderboard">
            <h2>LEADERBOARD</h2>
        <!-- Include the external JavaScript file -->
        <script>
        window.username = "{{ auth()->user()->name }}";
        </script>
        <script src="{{ asset('/js/leaderboard.js') }}"></script>
        </div>
    </div>
</div>
@endsection
