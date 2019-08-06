<?php

namespace App\Http\Controllers;

use App\Article;
use App\ContactUs;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $article = Article::inRandomOrder()->first();
        return view('contactus')->with('article',$article);
    }

    public function sendmessage (ContactUsRequest $request)
    {
        $contact_us = new ContactUs;
        $contact_us->name = $request->input('name');
        $contact_us->email = $request->input('email');
        $contact_us->subject = $request->input('subject');
        $contact_us->message = $request->input('message');
        $contact_us->save();

        return redirect('/')->with('success', 'We appreciate you contacting us. One of our colleagues will get back to you shortly. Have a great day!');
    }
}
