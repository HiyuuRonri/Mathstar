<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ScoreController;

use HttpKernel;

Route::get('/', function () {
    return view('welcome'); // Or any other homepage view you have
});

// Ensure this line is above Auth routes to avoid conflict
Route::get('register/role', function(){
    return view('auth.role');
})->name('role');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Games exclusive for pupils
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':pupil'])->group(function () {
    Route::get('/games', function () {
        return view('games.games');
    })->name('games');

    Route::get('games/game1', function () {
        return view('games.game1');
    })->name('game1');

    Route::get('games/game2', function () {
        return view('games.game2');
    })->name('game2');

    Route::get('games/game3', function () {
        return view('games.game3');
    })->name('game3');
    
    Route::post('/submit-score', [ScoreController::class, 'submitScore']);
});


// Teacher views
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':teacher'])->group(function () {
    Route::get('/create-quiz', function () {
        return view('teacher.createquiz');
    })->name('create-quiz');

    Route::get('/student-stats', function () {
        return view('teacher.studentinfo');
    })->name('student-stats');
    
    Route::resource('quizzes', QuizController::class);
});

// Leaderboard routes
Route::prefix('leaderboard')->group(function () {
    Route::get('/', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::post('/', [LeaderboardController::class, 'store'])->name('leaderboard.store');
});