<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function addSubscriber(Request $r)
    {
        $checkbox = 1;
        $name = uniqid();
        $surname = uniqid();
        $email = uniqid().'@email.com';
        $request_fields = [
                'ABBONAMENT' => 'Si, ho un abbonamento in palestra',
                'NAME' => $name,
                'SURNAME' => $surname
        ];

        $MailChimp = new \DrewM\MailChimp\MailChimp(env('MAILCHIMP_AUTH'));

        $fields = json_decode($r->fields, true);
        $fields['ABBONAMENT'] = $fields['ABBONAMENT'] == 1 ? 'Si, ho un abbonamento in palestra' : 'No, non ho un abbonamento';

        $result = $MailChimp->post(
            "lists/8bcbc201d7/members",
            [
                'email_address' => $r->email,
                'status'        => 'subscribed',
                'merge_fields' => $fields,
            ]
        );

        if ($MailChimp->success()) {
            return response([
                'success' => true,
                'results' => $result,
            ]);
        } else {
            return response([
                'success' => false,
                'error' => $MailChimp->getLastError(),
                'results' => $result,
            ]);
        }
    }
}
