<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; // For generating random strings
use App\Models\Classroom;

class ClassroomController extends Controller
{
    // Display the form to create a classroom
    public function create()
    {
        return view('classroom.create');
    }

    // Handle the form submission to store classroom details and generate a classroom code
    public function store(Request $request)
    {
        // Validate the class name
        $request->validate([
            'class_name' => 'required|string|max:255',
        ]);

        // Generate a unique classroom code
        $classroomCode = Str::random(8); // Generate random 8-character string

        // Check if the classroom code already exists, and regenerate if necessary
        while (Classroom::where('class_code', $classroomCode)->exists()) {
            $classroomCode = Str::random(8); // Regenerate if the code exists
        }

        // Store the classroom in the database
        $classroom = Classroom::create([
            'class_name' => $request->class_name,
            'class_code' => $classroomCode,
        ]);

        // Return the classroom code in JSON format
        return response()->json(['class_code' => $classroomCode]);
    }
}

