<?php
namespace App\Http\Controllers;

use App\Models\Leaderboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    /**
     * Store the score, making sure it's a higher score than the existing one for the player.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'username' => 'required|string|max:255',
            'score' => 'required|integer',
        ]);

        // Check if a higher score exists for the user
        $existingScore = Leaderboard::where('username', $request->username)->max('score');
        
        // If the existing score is higher or equal to the new score, we don't update
        if ($existingScore >= $request->score) {
            return response()->json(['message' => 'Score not updated. Higher or equal score already exists.'], 200);
        }

        // Update or create the leaderboard entry for the user with the new score
        Leaderboard::updateOrCreate(
            ['username' => $request->username],
            ['score' => $request->score]
        );

        return response()->json(['message' => 'Score updated successfully.'], 201);
    }

    /**
     * Get the leaderboard (top 10 scores)
     */
    public function index()
    {
        $leaderboard = Leaderboard::select('username', DB::raw('MAX(score) as score'))
            ->groupBy('username')
            ->orderByDesc('score')
            ->take(10)
            ->get();

        return response()->json($leaderboard);
    }
}


