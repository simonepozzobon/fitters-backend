<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function get_user(Request $request)
    {
        $user = Auth::user();
        return [
            'success' => true,
            'user' => $user
        ];
    }

    public function login(Request $request)
    {
        $loginData = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($loginData)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;

            return [
                'success' => true,
                'token' => $token,
                'user' => $user
            ];
        }

        return [
            'success' => false,
            'error' => 'unhauthorised'
        ];
    }
}
