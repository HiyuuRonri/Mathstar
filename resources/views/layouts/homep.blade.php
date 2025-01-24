@extends('layouts.app')

@section('content')
<div class="container transparent-container2 text-center mt-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(Auth::check() && Auth::user()->trashed())
    <p>Your account is in a deleted state. You can recover it within 24 hours:</p>
    <a href="{{ route('account.recover', ['email' => Auth::user()->email]) }}">Recover Account</a>
    @endif

    <!-- Welcome Title -->
    <h1 class="display-4 fw-bold">Welcome to MathStar</h1>
    <p class="lead text-muted">Where Learning Meets Fun! Gamify your quizzes and make education engaging.</p>

    <!-- Features Section -->
    <div class="mt-5 row justify-content-center">
        <div class="col-md-4 text-center">
            <img src="/svg/quiz_icon_black.svg" alt="Quiz Icon" style="height: 80px;">
            <h5 class="mt-3">Gamified Quizzes</h5>
            <p class="text-muted">Turn ordinary quizzes into exciting ones!</p>
        </div>
        <div class="col-md-4 text-center">
            <img src="/svg/pencil_icon_black.svg" alt="Custom Quizzes Icon" style="height: 80px;">
            <h5 class="mt-3">Custom Quizzes</h5>
            <p class="text-muted">Create personalized quizzes tailored to your students' needs and goals.</p>
        </div>
    </div>

</div>
@endsection
