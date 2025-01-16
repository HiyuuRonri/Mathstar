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
    public function dashboard()
    {
        $quizzes = Quiz::latest()->get(); // Fetch all quizzes
        return view('teacher.quizzes', compact('quizzes'));
    }

    /**
     * Show the form to edit a quiz.
     */
    public function edit(Quiz $quiz)
    {
        return view('teacher.editquizzes', compact('quiz'));
    }

    /**
     * Update a quiz.
     */
    /**
 * Update a quiz and its questions.
 */
public function update(Request $request, Quiz $quiz)
{
    // Validate input data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'questions' => 'required|array|min:1', // Ensure at least one question
        'questions.*.id' => 'nullable|exists:questions,id', // Existing question IDs
        'questions.*.question_text' => 'required|string',
        'questions.*.is_correct' => 'required|boolean', // True/False for answers
    ]);

    // Update quiz details
    $quiz->update([
        'title' => $validated['title'],
        'description' => $validated['description'] ?? null,
    ]);

    // Handle questions
    $existingQuestionIds = $quiz->questions->pluck('id')->toArray(); // Get current question IDs
    $updatedQuestionIds = [];

    foreach ($validated['questions'] as $questionData) {
        if (isset($questionData['id']) && in_array($questionData['id'], $existingQuestionIds)) {
            // Update existing question
            $question = Question::find($questionData['id']);
            $question->update([
                'question_text' => $questionData['question_text'],
                'is_correct' => $questionData['is_correct'],
            ]);
            $updatedQuestionIds[] = $questionData['id']; // Track updated question IDs
        } else {
            // Add new question
            $quiz->questions()->create([
                'question_text' => $questionData['question_text'],
                'is_correct' => $questionData['is_correct'],
            ]);
        }
    }

    // Delete removed questions
    $questionsToDelete = array_diff($existingQuestionIds, $updatedQuestionIds);
    Question::destroy($questionsToDelete);

    // Update total_questions after all questions are added/removed/updated
    $quiz->update(['total_questions' => $quiz->questions->count()]);

    return redirect()->route('info-quiz')->with('success', 'Quiz and questions updated successfully!');
}


    /**
     * Delete a quiz.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('info-quiz')->with('success', 'Quiz deleted successfully!');
    }
}
