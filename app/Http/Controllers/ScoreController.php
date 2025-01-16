<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz; // Assuming you want to associate score with a quiz
use App\Models\Score; // A new model for storing scores

class ScoreController extends Controller
{
    public function submitScore(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'score' => 'required|integer',
        ]);

        // Store the score in a new model (make sure to create a Score model)
        $score = new Score();
        $score->username = $validated['username'];
        $score->score = $validated['score'];
        $score->save();

        return response()->json([
            'message' => 'Score submitted successfully!',
            'score' => $score,
        ]);
    }
}
