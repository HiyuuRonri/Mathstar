<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ScoreController;

// Define the route to submit scores
Route::post('/submit-score', [LeaderboardController::class, 'store']);

// Define a route to get the leaderboard
Route::get('/leaderboard', [LeaderboardController::class, 'index']);

Route::post('/submit-score', [ScoreController::class, 'submitScore']);