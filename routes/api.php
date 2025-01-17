<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\QuizController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Define the route to submit scores
Route::post('/submit-score', [ScoreController::class, 'submitScore']);

// Route to get only the questions for a specific quiz
Route::get('/questions', [QuizController::class, 'getOnlyQuestions']);

