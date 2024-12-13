<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

//        die('ghelklo');
        // Attempt login with is_admin check
        if (Auth::attempt(array_merge($credentials, ['is_admin' => true]))) {
            return redirect()->route('admin.dashboard'); // Adjust to your admin route
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or unauthorized access.',
        ]);
    }
}
