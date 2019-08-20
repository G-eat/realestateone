<?php

namespace App\Http\Controllers\Admin;

use App\AboutUs;
use App\Article;
use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function articles ()
    {
        return view('admin.articles');
    }

    public function contactus ()
    {
        return view('admin.contactus');
    }

    public function aboutus ()
    {
        $aboutus = AboutUs::first();
        return view('admin.aboutus')->with('aboutus',$aboutus);
    }
}
