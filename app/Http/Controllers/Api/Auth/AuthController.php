<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Login user dengan username/email dan password.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required_without:email|string',
            'email' => 'required_without:username|email',
            'password' => 'required|string|min:6',
        ]);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        return response()->json([
            'username_or_email' => $request->username ?? $request->email,
            'password' => '********',
            'token' => $token,
        ], 200);
    }

    /**
     * Logout user (invalidate token).
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Dapatkan data user yang sedang login.
     */
    public function profile()
    {
        $user = JWTAuth::user();
        return response()->json($user);
    }
}
