<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();

        if (empty($data['email'])) {
            return response(['message' => 'Email must be filled']);
        }

        if (empty($data['password'])) {
            return response(['message' => 'Password must be selected']);
        }

        $user = User::where('email', $data['email'])->first();

        if (!Auth::attempt($data)) {
            return response(['message' => 'User credential not found'], 404);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response(['user' => Auth::user(), 'token' => $token, 'token_type' => 'Bearer'], 201);
    }

    public function logout(Request $request)
    {
        auth('sanctum')->user()->currentAccessToken()->delete();

        return response(['message' => 'Logged out'], 200);
    }
}
