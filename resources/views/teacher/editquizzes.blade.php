@extends('layouts.app')

@section('content')
<div class="container transparent-container">
    <h1 class="my-4">Edit Quiz</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('quizzes.update', $quiz) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Quiz Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $quiz->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Quiz Description</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $quiz->description) }}</textarea>
        </div>

        <div id="questions-container">
            <h4 class="my-4">Questions</h4>

            @foreach ($quiz->questions as $index => $question)
                <div class="question" data-index="{{ $index }}">
                    <h5>Question {{ $index + 1 }}</h5>
                    <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">

                    <div class="form-group">
                        <input type="text" name="questions[{{ $index }}][question_text]" class="form-control" 
                               value="{{ $question->question_text }}" required>
                    </div>

                    <div class="form-check">
                        <input type="radio" name="questions[{{ $index }}][is_correct]" value="1" 
                               class="form-check-input" {{ $question->is_correct ? 'checked' : '' }} required>
                        <label class="form-check-label">True</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="questions[{{ $index }}][is_correct]" value="0" 
                               class="form-check-input" {{ !$question->is_correct ? 'checked' : '' }} required>
                        <label class="form-check-label">False</label>
                    </div>

                    <!-- Delete Button -->
                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-question">Delete</button>
                </div>
            @endforeach
        </div>
        <div class="d-flex gap-2 mt-3">
            <button type="button" id="add-question" class="btn btn-primary mt-3">Add Question</button>
            <button type="submit" class="btn btn-success mt-3">Save Changes</button>
            <a href="{{ route('info-quiz') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let questionIndex = {{ $quiz->questions->count() }};
        const addQuestionButton = document.getElementById('add-question');
        const questionsContainer = document.getElementById('questions-container');

        addQuestionButton.addEventListener('click', function () {
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question');
            newQuestion.setAttribute('data-index', questionIndex);

            newQuestion.innerHTML = `
                <h5>Question ${questionIndex + 1}</h5>
                <div class="form-group">
                    <input type="text" name="questions[${questionIndex}][question_text]" class="form-control" placeholder="Enter the question text" required>
                </div>

                <div class="form-check">
                    <input type="radio" name="questions[${questionIndex}][is_correct]" value="1" class="form-check-input" required>
                    <label class="form-check-label">True</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="questions[${questionIndex}][is_correct]" value="0" class="form-check-input" required>
                    <label class="form-check-label">False</label>
                </div>

                <!-- Delete Button -->
                <button type="button" class="btn btn-danger btn-sm mt-2 delete-question">Delete</button>
            `;

            questionsContainer.appendChild(newQuestion);
            questionIndex++;
        });

        // Delete question functionality
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('delete-question')) {
                const questionDiv = e.target.closest('.question');
                if (questionDiv) {
                    questionDiv.remove();  // Remove question from DOM
                }
            }
        });
    });
</script>
@endsection
