<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests\SearchRequest;

class ArticleController extends Controller
{
    public function index($sortBy = 'latest')
    {
        if ($sortBy == 'most-viewed') {
            $articles = Article::orderBy('views', 'desc')->paginate(9);
        } else {
            $articles = Article::orderBy('updated_at', 'desc')->paginate(9);
        }

        $randomArticles = Article::inRandomOrder()->take(5)->get();

        return view('article.index')
                                    ->with('sortby', $sortBy)
                                    ->with('articles', $articles)
                                    ->with('randomarticles', $randomArticles);
    }

    public function viewList($sortBy = 'latest')
    {
        if ($sortBy == 'most-viewed') {
            $articles = Article::orderBy('views', 'desc')->paginate(9);
        } else {
            $articles = Article::orderBy('updated_at', 'desc')->paginate(9);
        }

        $randomArticles = Article::inRandomOrder()->take(5)->get();

        return view('article.viewList')
                                        ->with('sortby', $sortBy)
                                        ->with('articles', $articles)
                                        ->with('randomarticles', $randomArticles);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $photos = $article->photo;

        return view('article.show')
                                    ->with('article', $article)
                                    ->with('photos', $photos);
    }

    public function search(SearchRequest $request)
    {

        $price_from    = $request->input('price_from');
        $price_to      = $request->input('price_to');
        $for           = $request->input('offer-types');
        $city          = $request->input('city');
        $type          = $request->input('type');

        $articles = Article::when($price_from, function($query) use ($price_to, $price_from) {
            $query->where('price', '>=', $price_from)->where('price', '<=', $price_to);
        })
        ->when($for, function($query) use($for) {
            $query->where('for', $for);
        })
        ->when($city, function($query) use($city) {
            $query->where('city', $city);
        })
        ->when($type, function ($query) use ($type){
            $query->where('type',$type);
        })
        ->paginate(9);

        $sortBy = 'latest';
        $randomArticles = Article::inRandomOrder()->take(5)->get();


        return view('article.search')
                                            ->with('price_from', $price_from)
                                            ->with('price_to', $price_to)
                                            ->with('for', $for)
                                            ->with('city', $city)
                                            ->with('type', $type)
                                            ->with('sortby', $sortBy)
                                            ->with('articles', $articles)
                                            ->with('randomarticles', $randomArticles);
    }
}
