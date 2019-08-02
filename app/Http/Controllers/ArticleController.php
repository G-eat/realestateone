<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index($sortBy = 'latest')
    {
        if ($sortBy == 'most-viewed') {
            $articles = Article::orderBy('views', 'desc')->paginate(12);
            $randomArticle = Article::inRandomOrder()->take(5)->get();
        } else {
            $articles = Article::orderBy('updated_at', 'desc')->paginate(12);
            $randomArticle = Article::inRandomOrder()->take(5)->get();
        }
        return view('article.index')
                                    ->with('sortby', $sortBy)
                                    ->with('articles', $articles)
                                    ->with('randomarticles', $randomArticle);
    }

    public function viewList($sortBy = 'latest')
    {
        if ($sortBy == 'most-viewed') {
            $articles = Article::orderBy('views', 'desc')->paginate(12);
            $randomArticle = Article::inRandomOrder()->take(5)->get();
        } else {
            $articles = Article::orderBy('updated_at', 'desc')->paginate(12);
            $randomArticle = Article::inRandomOrder()->take(5)->get();
        }

        return view('article.viewList')
                                        ->with('sortby', $sortBy)
                                        ->with('articles', $articles)
                                        ->with('randomarticles', $randomArticle);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $photos = $article->photo;

        return view('article.show')
                                    ->with('article', $article)
                                    ->with('photos', $photos);
    }

    public function search(Request $request)
    {
        // + validimin
        // if ($price_from == '' ||) {
        //     $price_from = 0;
        // }
        $price_from    = $request->input('price_from');
        $price_to      = $request->input('price_to');
        $for           = $request->input('offer-types');
        $city          = $request->input('city');
        $type          = $request->input('type');

        $articles = Article::where([
            ['price', '>=' , $price_from],
            ['price', '<=' , $price_to],
            ['for'  , '>=' , $for],
            ['city' , '>=' , $city],
            ['type' , '>=' , $type],
        ])->paginate(12);


        return view('article.search')->with('articles', $articles);
    }
}
