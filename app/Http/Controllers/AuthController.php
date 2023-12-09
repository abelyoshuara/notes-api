<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User logged successfully',
            'data' => [
                'accessToken' => $user->createToken('ApiToken')->plainTextToken
            ],
        ]);
    }

    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
        ]);
    }

    public function logout()
    {
        $user = Auth::user();

        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
        ]);
    }
}
