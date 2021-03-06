<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * LoginController class
 */

class LoginController extends Controller
{
    public function getUser(Request $request)
    {
        $user = Auth::user();
        $user->details = $user->details;
        $user->subscriptions = $user->subscriptions;

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
            $user->details = $user->details;
            $user->subscriptions = $user->subscriptions;

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

    public function register(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return [
                'success' => false,
                'message' => 'same-email'
            ];
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user_details = new UserDetail();
            $user_details->user_id = $user->id;
            $user_details->age = $request->age;
            $user_details->address = $request->address;
            $user_details->city = $request->city;
            $user_details->save();

            $user->details = $user->details;

            return [
                'success' => true,
                'user' => $user,
                'details' => $user_details
            ];
        }
    }
}
