<?php

namespace App\Http\Controllers;

use App\AboutUs;
use App\Http\Requests\AboutUsRequest;
use Illuminate\Http\Request;
use App\Article;

class AboutUsController extends Controller
{
    public function index()
    {
        $article = Article::inRandomOrder()->first();
        $about_us = AboutUs::first();
        return view('article.aboutus')
                                    ->with('article',$article)
                                    ->with('about_us',$about_us);
    }

    public function update(AboutUsRequest $request)
    {
        $about_us = AboutUs::first();

        if($about_us->title === $request->input('title') && $about_us->body === $request->input('body'))
        {
            return "Error" ;
        } else {
            $about_us->title = $request->input('title');
            $about_us->body = $request->input('body');
            $about_us->save();

            return "Success" ;
        }

    }

}
