<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function studentDashboard()
    {
        // Retrieve users with the role 'pupil'
        $students = User::where('role', 'pupil')->get();

        // Pass the students to the view
        return view('teacher.studentinfo', compact('students'));
    }
}
