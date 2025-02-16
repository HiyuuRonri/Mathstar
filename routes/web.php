<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Mail\NewUserWelcomeEmail;


Route::get('/', function () {
    return view('layouts.homep'); // Or any other homepage view you have
});



// Ensure this line is above Auth routes to avoid conflict
Route::get('register/role', function(){
    return view('auth.role');
})->name('role');

// Redirect /register to /register/role
Route::get('/register', function(){
    return redirect('/register/role');
});
Auth::routes([
    'verify'=>true
]);

//account deletion
Route::middleware('auth')->group(function () {
    Route::delete('/account/delete', [AccountController::class, 'destroy'])->name('account.destroy');
});

Route::get('/recover-account/{email}', [AccountController::class, 'recover'])->name('account.recover');


// Games exclusive for pupils
Route::middleware(['auth','verified', \App\Http\Middleware\RoleMiddleware::class . ':pupil'])->group(function () {
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

});


// Teacher views
Route::middleware(['auth','verified', \App\Http\Middleware\RoleMiddleware::class . ':teacher'])->group(function () {
    Route::get('/create-quiz', function () {
        return view('teacher.createquiz');
    })->name('create-quiz');

    Route::get('/student-stats', [UserController::class, 'studentDashboard'])->name('student-stats');

    Route::get('/info-quiz', [QuizController::class, 'dashboard'])->name('info-quiz');

    Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');

    Route::put('/quizzes/{quiz}', [QuizController::class, 'update'])->name('quizzes.update');

    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
    
    Route::resource('quizzes', QuizController::class);
});

// Leaderboard routes
Route::prefix('leaderboard')->group(function () {
    Route::get('/', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::post('/', [LeaderboardController::class, 'store'])->name('leaderboard.store');
});

//admin page
Route::middleware(['auth','verified', \App\Http\Middleware\AdminMiddleware::class . ':admin' ])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::post('/admin-dashboard/set-registration-password', [AdminController::class, 'setRegistrationPassword'])->name('admin.setRegistrationPassword');
});
