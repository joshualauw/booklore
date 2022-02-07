<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            "email.required" => "email must not be empty",
            "password.required" => "password must not be empty"
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'errors' => [
                    "credentials" => [
                        'These credentials do not match our records.'
                    ]
                ]
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users,email|email:rfc,dns',
            'password' => 'required|confirmed',
            'phone' => 'required|min:12'
        ], [
            "username.required" => "username must not be empty",
            "email.required" => "email must not be empty",
            "phone.required" => "phone must not be empty",
            "password.required" => "password must not be empty",
            "phone.min" => "Phone must at least have 12 digits"
        ]);

        $user = User::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "phone" => $request->phone
        ]);

        return response()->json([
            "data" => new UserResource($user),
            "message" => 'User Created!'
        ]);
    }
}
