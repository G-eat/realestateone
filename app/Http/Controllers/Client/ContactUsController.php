<?php

namespace App\Http\Controllers\Client;

use App\Article;
use App\ContactUs;
use App\Http\Controllers\Controller;
use App\Events\SendEmailOfContactUsEvent;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $article = Article::inRandomOrder()->first();
        return view('article.contactus')->with('article',$article);
    }

    public function sendmessage (ContactUsRequest $request)
    {
        $contact_us = new ContactUs;
        $contact_us->name = $request->input('name');
        $contact_us->email = $request->input('email');
        $contact_us->subject = $request->input('subject');
        $contact_us->message = $request->input('content');
        $contact_us->save();

        $notification = [
            'message' => 'We appreciate you contacting us. One of our colleagues will get back to you shortly. Have a great day!',
            'alert-type' => 'success'
        ];

        event(new SendEmailOfContactUsEvent($contact_us));

        return redirect('/')->with($notification);
    }

//    public function destroy ($id)
//    {
//        $contact = ContactUs::findOrFail($id);
//        $contact->delete();
//    }
//
//    public function show ($id)
//    {
//        $contact = ContactUs::findorFail($id);
//
//        return view('admin.contact_show')->with('contact',$contact);
//    }
}
