<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the main Quiz table
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Quiz title
            $table->text('description')->nullable(); // Quiz description
            $table->integer('total_questions')->default(0); // Number of questions
            $table->timestamps();
        });

        // Create the related Questions table
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade'); // Foreign key to Quiz
            $table->text('question_text'); // The question itself
            $table->boolean('is_correct')->default(false); // Indicates the correct answer (true or false)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the tables
        Schema::dropIfExists('questions');
        Schema::dropIfExists('quizzes');
    }
};
