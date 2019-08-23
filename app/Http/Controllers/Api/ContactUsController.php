<?php

namespace App\Http\Controllers\Api;

use App\ContactUs;
use App\Events\SendEmailOfContactUsEvent;
use App\Http\Requests\ApiContactUsRequest;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function sendmessage (ApiContactUsRequest $request)
    {
        $contact_us = new ContactUs;
        $contact_us->name = $request['name'];
        $contact_us->email = $request['email'];
        $contact_us->subject = $request['subject'];
        $contact_us->message = $request['content'];
        $contact_us->save();


        event(new SendEmailOfContactUsEvent($contact_us));

        return response()->json([
            "Message" => "message send"
        ]);
    }
}
