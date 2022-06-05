<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Auth Register
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('InvestreeFullstack')->accessToken;

        $data = [
            'token' => $token,
            'name' => $user['name'],
            'email' => $user['email']
        ];

        return response()->json([
            'message' => 'User registered successfully',
            'data' => $data
        ], 200);
    }

    // Login User
    public function login(Request $request)
    {

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);


        if (auth()->attempt($formFields)) {
            $token = auth()->user()->createToken('InvestreeFullstack')->accessToken;
            return response()->json([
                'message' => 'You are now logged in',
                'data' => [
                    'token' => $token,
                    'name' => auth()->user()->name
                ]
            ], 200);
        } else {
            return response()->json([
                'error' => 'Unauthorised'
            ], 401);
        }
    }
}
