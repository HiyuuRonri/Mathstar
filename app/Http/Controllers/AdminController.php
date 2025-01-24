<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function setRegistrationPassword(Request $request)
    {
        $request->validate([
            'registration_password' => 'required|string|min:8',
        ]);

        // Update the registration password for admin
        $admin = User::where('role', 'admin')->first();

        if ($admin) {
            $admin->update([
                'registration_password' => Hash::make($request->registration_password),
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Registration password updated successfully.');
    }
    public function deleteUser($id)
    {
        // Fetch the user to be deleted
        $user = User::findOrFail($id);

        // Prevent deletion of admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Admin users cannot be deleted.');
        }

        // Delete the user
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}

