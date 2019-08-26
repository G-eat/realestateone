<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Requests\ApiSearchRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/article/{sortBy}",
     *     operationId="Articles",
     *     summary="Articles",
     *     tags={"Articles"},
     *     @OA\Parameter(
     *          name="sortBy",
     *          in="path",
     *          required=true,
     *          example="latest",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
    public function index($sortBy = 'latest')
    {

        if($sortBy == 'latest' || $sortBy == 'most-viewed' || $sortBy == '')
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

        return response()->json([
            'Message' => 'Error in url'
        ]);
    }


    /**
     * @OA\Get(
     *     path="/api/article/property/{id}",
     *     operationId="Property",
     *     summary="Show one article",
     *     tags={"Property"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
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


    /**
     * @OA\Get(
     *     path="/api/search",
     *     operationId="Search",
     *     summary="Search",
     *     tags={"Search"},
     *     @OA\Parameter(
     *          name="price_from",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="price_to",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="offer_types",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="city",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="type",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
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
