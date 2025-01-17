@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    
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
