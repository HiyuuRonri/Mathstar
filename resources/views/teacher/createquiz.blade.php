@extends('layouts.app')

@section('content')
<div class="container transparent-container">
    <h1>Create a New Quiz</h1>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <!-- Quiz Title -->
        <div class="form-group">
            <label for="title">Quiz Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter quiz title" required>
        </div>

        <!-- Quiz Description -->
        <div class="form-group">
            <label for="description">Quiz Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter a description" rows="3"></textarea>
        </div>

        <!-- Questions Section -->
        <div id="questions-container">
            <!-- Initial Question Template -->
            <div class="question" data-index="0">
                <h5>Question 1</h5>
                <div class="form-group">
                    <input type="text" name="questions[0][question_text]" class="form-control" placeholder="Enter the question text" required>
                </div>

                <!-- True/False Options -->
                <div class="form-check">
                    <input type="radio" name="questions[0][is_correct]" value="1" class="form-check-input" required>
                    <label class="form-check-label">True</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="questions[0][is_correct]" value="0" class="form-check-input" required>
                    <label class="form-check-label">False</label>
                </div>
            </div>
        </div>


        <!-- Buttons Section -->
        <div class="d-flex gap-2 mt-3">
            <!-- Add Question Button -->
            <button type="button" class="btn btn-primary" id="add-question">Add Question</button>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Save Quiz</button>
        </div>
    </form>
</div>

<!-- JavaScript for dynamically adding true/false questions -->
<script src="{{ asset('/js/true-false-questions.js') }}"></script>
@endsection
