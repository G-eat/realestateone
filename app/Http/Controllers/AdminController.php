<?php

namespace App\Http\Controllers;

use App\AboutUs;
use App\ContactUs;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function articles ()
    {
        return view('admin.articles');
    }

    public function contactus ()
    {
        $contacts = ContactUs::all();
        return view('admin.contactus')->with('contacts',$contacts);
    }

    public function aboutus ()
    {
        $aboutus = AboutUs::first();
        return view('admin.aboutus')->with('aboutus',$aboutus);
    }
}
