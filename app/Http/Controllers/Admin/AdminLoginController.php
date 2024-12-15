<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Admin login view
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login with is_admin check
//        if (Auth::attempt(array_merge($credentials, ['is_admin' => true]))) {
//            return redirect()->route('admin.dashboard');
//        }

        // Attempt login only if the user is an admin
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
//            dd($user);

            // Check if the logged-in user is an admin
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout(); // Logout if the user is not an admin
                return back()->withErrors([
                    'email' => 'Unauthorized access.',
                ]);
            }
        }


        return back()->withErrors([
            'email' => 'Invalid credentials or unauthorized access.',
        ]);
    }

    public function logout()
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        request()->session()->invalidate();

        // Regenerate the session token
        request()->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('admin.login')->with('status', 'You have been logged out successfully.');
    }
}
