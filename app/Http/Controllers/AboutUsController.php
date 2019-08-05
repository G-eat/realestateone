<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class AboutUsController extends Controller
{
    public function index()
    {
        $article = Article::inRandomOrder()->first();
        return view('aboutus')->with('article',$article);
    }

}
