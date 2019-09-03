<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Requests\ApiSearchRequest;
use App\Http\Requests\ApiCreateArticleRequest;
use App\Http\Requests\ApiUpdateArticleRequest;
use App\Photo;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Auth;

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


    /**
     * @OA\Get(
     *     path="/api/articles",
     *     operationId="Articles",
     *     summary="Articles",
     *     tags={"Admin/User Articles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(),
     *     )
     * )
     *
     */
    public function articles()
    {
        if (Gate::allows('admin')) {
            $articles = Article::select(['id','title','city','address','type','phonenumber'])->get();
        } elseif (Gate::allows('user')) {
            $user = Auth::user();
            $articles = Article::where('user_id',$user->id)->select(['id','title','city','address','type','phonenumber'])->get();
        }

        return response()->json([
            "Articles" => $articles
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/create-article",
     *     operationId="Create Articles",
     *     summary="Create Articles",
     *     tags={"Create Articles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="title",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="body",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="price",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="city",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="address",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="for",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="price",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="type",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="available",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="phone_number",
     *          in="query",
     *          required=true,
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
    public function store (ApiCreateArticleRequest $request)
    {
//        return response()->json([
////           "a"=> $request['filenames']
////        ]);
////


        $article = Article::create([
            'user_id'       => \Illuminate\Support\Facades\Auth::user()->id,
            'title'         => $request['title'],
            'body'          => $request['body'],
            'city'          => $request['city'],
            'address'       => $request['address'],
            'for'           => $request['for'],
            'price'         => $request['price'],
            'type'          => $request['type'],
            'available'     => $request['available'],
            'phonenumber'   => $request['phone_number'],
        ]);

        if($request['filenames']){
            foreach($request['filenames'] as $file)
            {
//                dd(1);
                $name=time() . '-' . $file->getClientOriginalName();
                $file->storeAs('public/photos' , $name);
                $data[] = $name;
            }
//            dd($request['filenames']);
            $first_photo = $data[0];


            foreach ($data as $photo_name) {
                $photo = new Photo();
                $photo->article_id = $article->id;
                $photo->photo = $photo_name;
                if ($first_photo === $photo_name) {
                    $photo->is_thumbnail = 1;
                } else {
                    $photo->is_thumbnail = 0;
                }
                $photo->save();
            }
        } else {
            $name='default.jpg';


            $photo = new Photo();
            $photo->article_id = $article->id;
            $photo->photo = $name;
            $photo->is_thumbnail = 1;
            $photo->save();
        }



        return response()->json([
            'Message' => 'You created new article!'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/property/{id}",
     *     operationId="ArticleInfo",
     *     summary="ArticleInfo",
     *     tags={"Admin/User ArticleInfo"},
     *     security={{"bearerAuth":{}}},
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
    public function showarticlesinfo ($id) {

        if (Gate::allows('admin')) {
            $article = Article::findorFail($id);
        } elseif (Gate::allows('user')) {
            $article = Article::where('user_id',Auth::user()->id)->find($id);
        }

        return response()->json([
            'Article'=> $article
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/article/delete/{id}",
     *     operationId="ArticleDelete",
     *     summary="ArticleDelete",
     *     tags={"ArticleDelete"},
     *     security={{"bearerAuth":{}}},
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
    public function destroy ($id)
    {
        if (Gate::allows('admin')) {
            $article = Article::find($id);
        } elseif (Gate::allows('user')) {
            $article = Article::where('user_id',Auth::user()->id)->find($id);
        }

        if(!$article)
        {
            return response()->json([
                "Message"=>"Article not found"
            ]);
        }

        $photos = $article->photo;

        foreach ($photos as $photo)
        {
            Storage::delete('public/photos/'.$photo->photo);
        }

        Photo::where('article_id',$article->id)->delete();

        $article->delete();

        return response()->json([
           "Message"=>"You Deleted an article"
        ]);
    }


    /**
     * @OA\Put(
     *     path="/api/update-article/{id}",
     *     operationId="Update Articles",
     *     summary="Update Articles",
     *     tags={"Update Articles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="title",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="body",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="price",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="city",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="address",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="for",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="price",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="type",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="available",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="phonenumber",
     *          in="query",
     *          required=true,
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
    public function update(ApiUpdateArticleRequest $request, $id)
    {
        if (Gate::allows('admin')) {
            $article = Article::findorFail($id);
            if(!$article) {
                return response()->json([
                    'Message' => 'No article with this id!',
                ]);
            }
        } elseif (Gate::allows('user')) {
            $article = Article::where('user_id','=',Auth::user()->id)->findorFail($id);
            if(!$article) {
                return response()->json([
                    'Message' => 'Your not allowed to update this article!',
                ]);
            }
        }

        $changes = $this->change($request->except('filenames'), $article);

        if($changes) {
            Article::where('id', $id)->update($changes);
        }

        if($request['filenames']){
            if($request->file('filenames') > 0)
            {
                $this->destroyOldPhotos($id);


                foreach($request->file('filenames') as $file)
                {
                    $photo = new Photo();
                    $photo->article_id = $article->id;

                    $name=time() . '-' . $file->getClientOriginalName();
                    $file->storeAs('public/photos' , $name);
                    $data[] = $name;
                }

                $first_photo = $data[0];

                foreach ($data as $photo_name) {
                    $photo = new Photo();
                    $photo->article_id = $article->id;
                    $photo->photo = $photo_name;
                    if ($first_photo === $photo_name) {
                        $photo->is_thumbnail = 1;
                    } else {
                        $photo->is_thumbnail = 0;
                    }
                    $photo->save();
                }
            }
        }

        return response()->json([
            'Message' => 'You updated an article!',
        ]);

    }
    public function change($data,$article)
    {
        $article->fill($data);
//        dd($data);
        $changes = $article->getDirty();
//        dd($article);
        if (count($changes) == 0) {
            return false;
        } else {
            return $changes;
        }
    }
    public function destroyOldPhotos($id)
    {
        $article = Article::findOrFail($id);
        $photos = $article->photo;

        foreach ($photos as $photo)
        {
            Storage::delete('public/photos/'.$photo->photo);
        }

        Photo::where('article_id',$article->id)->delete();
    }
}
