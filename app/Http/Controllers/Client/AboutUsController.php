<?php

namespace App\Http\Controllers\Client;

use App\AboutUs;
use App\Http\Controllers\Controller;
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

//    public function update(Request $request)
//    {
//        $about_us = AboutUs::first();
//
//        if($request->input('title') == '' || $request->input('body') == '' )
//        {
//            return "Empty" ;
//        }
//
//        $changes = $this->change($request->all(),$about_us);
//
//        if($changes)
//        {
//            AboutUs::first()->update($changes);
//
//            return "Success" ;
//        }
//
//    }
//    public function change($data,$about_us)
//    {
//        $about_us->fill($data);
//        $changes = $about_us->getDirty();
//        if (count($changes) == 0) {
//                return false;
//        } else {
//            return $changes;
//        }
//    }

}
