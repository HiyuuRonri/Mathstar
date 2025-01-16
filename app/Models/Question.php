<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Specify the table (optional if table name is "questions")
    protected $table = 'questions';

    // Define the fillable properties for mass assignment
    protected $fillable = [
        'quiz_id',
        'question_text',
        'is_correct', // True/False value for the question
    ];

    /**
     * Relationship: A question belongs to a quiz.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
