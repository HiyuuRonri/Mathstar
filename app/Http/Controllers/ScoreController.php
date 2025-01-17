<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score; // Import the Score model

class ScoreController extends Controller
{
    public function __construct()
    {
        // Use auth middleware to ensure the user is authenticated
        $this->middleware('auth:sanctum'); // Adjust according to your authentication method (e.g., passport or sanctum)
    }

    public function submitScore(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'score' => 'required|integer', // Only score is required, username will be fetched from auth
        ]);

        // Fetch the authenticated user's username
        $user = auth()->user();

        // Store the score associated with the authenticated user
        $score = new Score();
        $score->username = $user->name; // Get the authenticated user's name
        $score->score = $validated['score'];
        $score->save();

        // Return a success response
        return response()->json([
            'message' => 'Score submitted successfully!',
            'score' => $score,
        ], 201); // 201 is the status code for resource creation
    }
}

