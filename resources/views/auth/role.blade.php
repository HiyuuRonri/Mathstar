@extends('layouts.app')

@section('content')

<form method="GET" action="{{ route('register') }}">

    <div class="row mb-3">
        <label for="role" class="col-md-4 col-form-label text-md-end">Role</label>
        <div class="col-md-6">
            <select id="role" class="form-control" name="role" required>
                <option value="teacher">Teacher</option>
                <option value="pupil">Pupil</option>
            </select>
        </div>
    </div>
    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
    </div>
</form>

@endsection
