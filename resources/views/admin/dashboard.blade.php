@extends('layouts.app')

@section('content')
<div class="container transparent-container2">
    <h1>Admin Dashboard</h1>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <!-- Form to Set Registration Password -->
    <form method="POST" action="{{ route('admin.setRegistrationPassword') }}">
        @csrf
        <div class="mb-3">
            <label for="registration_password" class="form-label">Set Registration Password</label>
            <input type="text" class="form-control @error('registration_password') is-invalid @enderror" id="registration_password" name="registration_password" required>
            @error('registration_password')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <!-- User Table -->
    <h2 class="mt-5">All Users</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @if($user->role !== 'admin')
                            <form method="POST" action="{{ route('admin.deleteUser', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>Cannot Delete</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
