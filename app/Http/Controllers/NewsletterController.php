<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function addSubscriber(Request $r)
    {
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
