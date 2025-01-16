<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // Specify the table if it's not pluralized automatically (optional if table name is "quizzes")
    protected $table = 'quizzes';

    // Define the fillable properties for mass assignment
    protected $fillable = [
        'title',
        'description',
        'total_questions',
    ];

    /**
     * Relationship: A quiz has many questions.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
