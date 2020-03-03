<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->options = ['details', 'subscriptions']
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if($user) {
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;

            if(isset($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $details = $user->details->first();
            if ($details) {
                $details->age = $request->age;
                $details->address = $request->address;
                $details->city = $request->city;
                $details->save();

                $user->save();
                $user->details = $user->details;
                $user->subscriptions = $user->subscriptions;

                return [
                    'success' => true,
                    'user' => $user
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'details-not-found'
                ];
            }

        } else {
            return [
                'success' => false,
                'message' => 'unhauthorised',
            ];
        }
    }
}
