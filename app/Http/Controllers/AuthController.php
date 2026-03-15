<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:8', 
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // Passing the raw password. We are trusting the User model to hash it!
            'password' => $validated['password'], 
            'role' => 'student', 
        ]);

        return response()->json([
            'message' => 'Account created successfully!',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Incorrect email or password.'
            ], 401); 
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful!',
            'user' => $user, 
            'token' => $token
        ], 200);
    }
}