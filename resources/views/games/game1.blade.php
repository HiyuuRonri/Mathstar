@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('unity/game2/TemplateData/style.css') }}">
    <title>Dynamic Mathstar</title>
</head>
<body style="padding: 0; margin: 0; text-align: center;">

    <div class="games-page">
        <h1>Game 1 - True or False Game</h1>

        <div class="thegame">
            <!-- Unity Game Section -->
            <canvas id="unity-canvas" width="800" height="600" tabindex="-1" 
                    style="width: 800px; height: 600px; background: #231F20;"></canvas>

            <!-- Leaderboard Section -->
            <!-- <div class="leaderboard">
                <h2>LEADERBOARD</h2> -->
                <!-- Include the external JavaScript file -->
                <!-- <script>
                    window.username = "{{ auth()->user()->name }}";
                </script>
                <script src="{{ asset('/js/leaderboard.js') }}"></script>
            </div>
        </div> -->

        <!-- Mathstar App Section -->
        <div id="app-container"></div>
        <noscript>You need to enable JavaScript to run this app.</noscript>
    </div>

    <!-- Unity Game Loader Script -->
    <script src="{{ asset('unity/game2/Build/Mathstar 1.4 ver.loader.js') }}"></script>
    <script>
        // Adjust style for mobile devices
        if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
            var meta = document.createElement('meta');
            meta.name = 'viewport';
            meta.content = 'width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, shrink-to-fit=yes';
            document.getElementsByTagName('head')[0].appendChild(meta);

            var canvas = document.querySelector("#unity-canvas");
            canvas.style.width = "100%";
            canvas.style.height = "100%";
            canvas.style.position = "fixed";

            document.body.style.textAlign = "left";
        }

        // Unity game instance creation
        createUnityInstance(document.querySelector("#unity-canvas"), {
            arguments: [],
            dataUrl: "{{ asset('unity/game2/Build/Mathstar 1.4 ver.data') }}",
            frameworkUrl: "{{ asset('unity/game2/Build/Mathstar 1.4 ver.framework.js') }}",
            codeUrl: "{{ asset('unity/game2/Build/Mathstar 1.4 ver.wasm') }}",
            streamingAssetsUrl: "StreamingAssets",
            companyName: "Outkasts",
            productName: "MathStars 1.0",
            productVersion: "1.0",
        }).then((unityInstance) => {
            console.log("Unity instance loaded successfully.");
        }).catch((error) => {
            console.error("Failed to load Unity instance:", error);
        });
    </script>
</body>
</html>
@endsection
