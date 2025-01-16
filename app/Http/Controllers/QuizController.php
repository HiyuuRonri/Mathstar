<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Store a new quiz with its questions.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.is_correct' => 'required|boolean', // Ensures True/False answer
        ]);

        // Create the quiz
        $quiz = Quiz::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        $totalQuestions = count($validated['questions']); // Get the number of questions
        // Add questions
        foreach ($validated['questions'] as $questionData) {
            $quiz->questions()->create([
                'question_text' => $questionData['question_text'],
                'is_correct' => $questionData['is_correct'], // Store True/False directly
            ]);
        }
        // Update total_questions after adding all the questions
        $quiz->update(['total_questions' => $totalQuestions]);

        // Redirect with success message
        return redirect()->route('create-quiz')->with('success', 'Quiz created successfully!');
    }
}
