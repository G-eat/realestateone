<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $article = Article::inRandomOrder()->first();
        return view('contactus')->with('article',$article);
    }
}
