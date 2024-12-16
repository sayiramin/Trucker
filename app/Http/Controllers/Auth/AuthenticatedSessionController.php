<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {

        try{
            // Validate the login request
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('API Token')->plainTextToken;

                return response()->json([
                    'message'   => 'Login successful',
                    'user'      => $user,
                    'token'     => $token,
                ], 200);
            }
        } catch (\Exception $e) {
            // Catch any exception and return a custom error message
            return response()->json([
                'error' => 'Login failed',
                'message' => $e->getMessage(),
            ], 500);
        }


        // If authentication fails
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function register(Request $request)
    {
        try {
            // Validate the incoming registration request
            $validated =  $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'phone' => ['required', 'string', 'max:15', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            // Automatically log the user in after registration
            Auth::login($user);

            // Generate an API token for the user
            $token = $user->createToken('API Token')->plainTextToken;

            // Return a success response with user and token
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
                'token' => $token,
            ], 201);
        } catch (\Exception $e) {
            // Catch any exception and return a custom error message
            return response()->json([
                'error' => 'Registration failed, please try again later.',
                'details' => $e->getMessage(),
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
