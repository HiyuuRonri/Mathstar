@extends('layouts.app')

@section('content')
<div class="text-center py-5">
    <h1>GAMESCHEST</h1>
    <h2>Here are the selection you can choose from!</h2>
    <div class="container-box2">
        <!-- IMPORT HERE THE IMAGES OF THE GAMES -->
    <a href="{{ route('game1') }}"><div class="card" style="background-image: url('./gameimg/game1.jpg');"></div></a>
    <a href="{{ route('game2') }}"><div class="card" style="background-image: url('./gameimg/game2.png');"></div></a>
    <a href="{{ route('game3') }}"><div class="card"></div></a>
    </div>
</div>
@endsection
