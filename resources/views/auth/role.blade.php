@extends('layouts.app')

@section('content')

<div class="role-selection-container">
    <form method="GET" action="{{ route('register') }}">
        <div class="role-cards">
            <label for="teacher" class="role-card">
                <input type="radio" id="teacher" name="role" value="teacher" required>
                <div class="role-image">
                    <img src="/svg/teacher.png" alt="Teacher Icon">
                </div>
                <p class="role-title">I'm a Teacher</p>
            </label>

            <label for="pupil" class="role-card">
                <input type="radio" id="pupil" name="role" value="pupil" required>
                <div class="role-image">
                    <img src="/svg/pupil.png" alt="Pupil Icon">
                </div>
                <p class="role-title">I'm a Pupil</p>
            </label>
        </div>

        <button type="submit" class="btn btn-success role-submit">Proceed</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const teacherRadio = document.getElementById('teacher');
        const pupilRadio = document.getElementById('pupil');

        teacherRadio.addEventListener('change', () => {
            if (teacherRadio.checked) {
                document.body.classList.add('teacher-role');
            }
        });

        pupilRadio.addEventListener('change', () => {
            if (pupilRadio.checked) {
                document.body.classList.remove('teacher-role');
            }
        });
    });
</script>

@endsection
