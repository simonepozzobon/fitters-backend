<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\AdminContact;
use App\Mail\UserContact;

class MailController extends Controller
{
    // public function __construct()
    // {
    //     $this->request = new Request();
    //     $this->request->replace([
    //         'name' => uniqid() . ' name',
    //         'surname' => uniqid() . ' cognome',
    //         'email' => uniqid() . '@email.com',
    //         'subject' => uniqid() . ' subject',
    //         'message' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    //     ]);
    // }

    public function sendMail(Request $request)
    {
        $admin_email = env('MAIL_FROM_ADDRESS', 'example@example.com');
        $errors = collect();
        // return (new UserContact($this->request))->render();
        Mail::to($admin_email)->send(new AdminContact($request));
        if (count(Mail::failures()) > 0) {
            $errors->push(Mail::failures());
        }
        Mail::to($request->email)->send(new UserContact($request));
        if (count(Mail::failures()) > 0) {
            $errors->push(Mail::failures());
        }

        if ($errors->count() > 0) {
            return [
            'success' => false,
            'errors' => $errors,
          ];
        }

        return [
          'success' => true
        ];
    }
}
