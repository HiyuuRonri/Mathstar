<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    // Specify the table (optional if table name is "answers")
    protected $table = 'answers';

    // Define the fillable properties for mass assignment
    protected $fillable = [
        'question_id',
        'answer_text',
        'is_correct',
    ];

    /**
     * Relationship: An answer belongs to a question.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
