<?php

namespace App\Http\Controllers;

use Auth;
use App\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();

        if($user) {
            $sub = new Subscription();
            $sub->user_id = $user->id;
            $sub->name = $request->name;
            $sub->address = $request->address;
            $sub->type = $request->type;
            $sub->number = $request->number;
            $sub->deadline = Carbon::now();
            $sub->save();

            $user->details = $user->details;
            $user->subscriptions = $user->subscriptions;

            return [
                'success' => true,
                'user' => $user,
            ];

        } else {
            return [
                'success' => false,
                'message' => 'unhauthorised',
            ];
        }
    }
}
