<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:16',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).+$/|confirmed'
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character!'
        ]);

        $user = User::create($fields);

        return response()->json([
            'message' => 'Register successful!',
            'user' => $user
        ], 201);
    }
}
