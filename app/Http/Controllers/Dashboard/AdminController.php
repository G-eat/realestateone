<?php

namespace App\Http\Controllers\Dashboard;

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
        return view('dashboard.home');
    }

//    public function articles ()
//    {
//        return view('dashboard.articles');
//    }

    public function contactus ()
    {
        return view('dashboard.contactus');
    }

    public function aboutus ()
    {
        $aboutus = AboutUs::first();
        return view('dashboard.aboutus')->with('aboutus',$aboutus);
    }
}
