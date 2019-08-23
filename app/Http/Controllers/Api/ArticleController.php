<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index($sortBy = 'latest')
    {
        if ($sortBy == 'most-viewed') {
            $articles = Article::with(['photo' => function($query) {
                $query->where('is_thumbnail', '=', 1);
            }])->orderBy('views', 'desc')->paginate(9);
        } else {
            $articles = Article::with(['photo' => function($query) {
                $query->where('is_thumbnail', '=', 1);
            }])->orderBy('created_at', 'desc')->paginate(9);
        }

        $randomArticles = Article::with(['photo' => function($query) {
            $query->where('is_thumbnail', '=', 1);
        }])->inRandomOrder()->take(5)->get();

        return response()->json([
            'Articles' => $articles,
            'Random Article : ' => $randomArticles
        ]);
    }

    public function show($id) {
        $article = Article::find($id);

        if(!$article){
            return response()->json([
               'Message' => 'No article with this Id.',
            ]);
        }

        $article->increment('views');

        $photos = $article->photo;

        if($article->for === 'rent') {
            $related_articles = Article::whereHas('photo', function ($query){
                $query->where('is_thumbnail',1);
            })->where('id','<>',$id)
                ->where(function ($query) use ($article){
                    $query->where('city', '=', $article->city)
                        ->whereBetween('price', [$article->price - 200, $article->price + 200]);
                })
                ->take(3)->get();
        } elseif($article->for === 'sale') {
            $related_articles = Article::whereHas('photo', function ($query){
                $query->where('is_thumbnail',1);
            })->where('id','<>',$id)
                ->where(function ($query) use ($article){
                    $query->where('city', '=', $article->city)
                        ->whereBetween('price', [$article->price - 10000, $article->price + 10000]);
                })
                ->take(3)->get();
        } else {
            $related_articles = Article::whereHas('photo', function ($query){
                $query->where('is_thumbnail',1);
            })->where('id','<>',$id)
                ->where(function ($query) use ($article){
                    $query->where('city', '=', $article->city);
                })
                ->take(3)->get();
        }

        return response()->json([
            'Article' => $article,
            'Article-Photos' => $photos,
            'Related-Article' => $related_articles
        ]);
    }

    public function search(ApiSearchRequest $request)
    {
        $price_from    = $request['price_from'];
        $price_to      = $request['price_to'];
        $for           = $request['offer_types'];
        $city          = $request['city'];
        $type          = $request['type'];

        $articles = Article::with(['photo' => function($query) {
            $query->where('is_thumbnail', '=', 1);
        }])->when($price_from, function($query) use ($price_to, $price_from) {
            $query->where('price', '>=', $price_from)->where('price', '<=', $price_to);
        })
            ->when($for, function($query) use($for) {
                $query->where('for', $for)->orWhere('for','both');
            })
            ->when($city, function($query) use($city) {
                $query->where('city', $city);
            })
            ->when($type, function ($query) use ($type){
                $query->where('type',$type);
            })
            ->paginate(9);

        $randomArticles = Article::inRandomOrder()->take(5)->get();

        if (!$articles) {
            return response()->json([
               'Message' => "We can't find any article"
            ]);
        }

        if (!$randomArticles) {
            return response()->json([
                'Message' => "We can't find any RELATED article"
            ]);
        }

        return response()->json([
            'price_from' => $price_from,
            'price_to' => $price_to,
            'for' => $for,
            'type' => $type,
            'city' => $city,
            'Articles' => $articles,
           'RandomArticles' => $randomArticles
        ]);

    }
}
