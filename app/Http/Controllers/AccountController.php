<?php

namespace App\Http\Controllers;
use App\Notifications\AccountDeletedNotification;
use App\Models\User;


use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function destroy()
    {
    $user = Auth::user();

    if (!$user) {
        return redirect('/')->with('error', 'User not found.');
    }

        // Soft delete the user
        $user->delete();

        // Notify the user via email
        $user->notify(new AccountDeletedNotification());

        // Logout the user
        Auth::logout();

        return redirect('/')->with('success', 'Your account has been scheduled for deletion. You have 24 hours to recover it. Please check your email for more details.');
    }

    public function recover($email)
    {
        $user = User::withTrashed()->where('email', $email)->first();

        if ($user && $user->trashed()) {
            $user->restore(); // Restore the user account
            return redirect('/')->with('success', 'Your account has been successfully recovered.');
        }

        return redirect('/')->with('error', 'Your account could not be recovered.');
    }


}

