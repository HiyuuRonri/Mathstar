@extends('layouts.app')

@section('content')
<div class="container transparent-container">
    <h1 class="my-4">Teacher Dashboard</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('create-quiz') }}" class="btn btn-primary mb-4">Create New Quiz</a>

    @if ($quizzes->isEmpty())
        <p>No quizzes found. Create your first quiz!</p>
    @else
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Total Questions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->id }}</td>
                        <td>{{ $quiz->title }}</td>
                        <td>{{ $quiz->description }}</td>
                        <td>{{ $quiz->total_questions }}</td>
                        <td>
                            <a href="{{ route('quizzes.edit', $quiz) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Are you sure you want to delete this quiz?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
