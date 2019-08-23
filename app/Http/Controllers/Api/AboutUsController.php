<?php

namespace App\Http\Controllers\Api;

use App\AboutUs;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index()
    {
        $article = Article::inRandomOrder()->first();
        $about_us = AboutUs::first();

        return response()->json([
           'Article' => $article,
           'About us' => $about_us
        ]);
    }
}
