<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Photo;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request ,$sortBy = 'latest')
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

//        if ($request->get('page') > $articles->lastPage() || is_int($request->get('page')) || ($request->get('page') < 1 && is_int($request->get('page'))))
//        {
//            return redirect('/')->with('status', 'Profile updated!');
//        }

        $randomArticles = Article::with(['photo' => function($query) {
            $query->where('is_thumbnail', '=', 1);
        }])->inRandomOrder()->take(5)->get();

        return view('article.index')
                                        ->with('sortby', $sortBy)
                                        ->with('articles', $articles)
                                        ->with('randomarticles', $randomArticles);
    }

    public function viewList($sortBy = 'latest')
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

        return view('article.viewList')
                                            ->with('sortby', $sortBy)
                                            ->with('articles', $articles)
                                            ->with('randomarticles', $randomArticles);
    }

    public function show($id)
    {
        $article = Article::findorFail($id);
        $article->increment('views');

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

        $articles = Article::with(['photo' => function($query) {
                $query->where('is_thumbnail', '=', 1);
            }])->when($price_from, function($query) use ($price_to, $price_from) {
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

        $randomArticles = Article::inRandomOrder()->take(5)->get();


        return view('article.search') ->with('price_from', $price_from)
                                            ->with('price_to', $price_to)
                                            ->with('for', $for)
                                            ->with('city', $city)
                                            ->with('type', $type)
                                            ->with('articles', $articles)
                                            ->with('randomarticles', $randomArticles);
    }

    public function edit ($id)
    {
        $article = Article::where('id', $id)->first();

        return view('admin.edit_article')->with('article',$article);
    }

    public function destroy ($id)
    {
        $article = Article::findOrFail($id);
        $photos = $article->photo;

        foreach ($photos as $photo)
        {
            Storage::delete('public/photos/'.$photo->path);
        }

        Photo::where('article_id',$article->id)->delete();

        $article->delete();
    }

    public function create () {
        return view('admin.create_article');
    }

    public function store (CreateArticleRequest $request)
    {
        foreach($request->file('filenames') as $file)
        {
            $name=time() . '-' . $file->getClientOriginalName();
            $file->storeAs('public/photos' , $name);
            $data[] = $name;
        }

        $article = Article::create([
            'title'         => $request->input('title'),
            'body'          => $request->input('body'),
            'city'          => $request->input('city'),
            'address'       => $request->input('address'),
            'for'           => $request->input('for'),
            'price'         => $request->input('price'),
            'type'          => $request->input('type'),
            'available'     => $request->input('available'),
            'phonenumber'   => $request->input('phone_number'),
        ]);

        $first_photo = $data[0];


        foreach ($data as $photo_name) {
            $photo = new Photo();
            $photo->article_id = $article->id;
            $photo->path = $photo_name;
            if ($first_photo === $photo_name) {
                $photo->is_thumbnail = 1;
            } else {
                $photo->is_thumbnail = 0;
            }
            $photo->save();
        }

        $notification = [
            'message' => 'You created new article!',
            'alert-type' => 'success'
        ];

        return redirect('/admin/articles') ->with($notification);
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        Article::where('id', $id)
                                ->update([
                                    'title'         => $request->input('title'),
                                    'body'          => $request->input('body'),
                                    'city'          => $request->input('city'),
                                    'address'       => $request->input('address'),
                                    'for'           => $request->input('for'),
                                    'price'         => $request->input('price'),
                                    'type'          => $request->input('type'),
                                    'available'     => $request->input('available'),
                                    'phonenumber'   => $request->input('phone_number'),
                                ]);

        $article = Article::find($id);


        if($request->file('filenames') > 0)
        {
            foreach($request->file('filenames') as $file)
            {
                $photo = new Photo();
                $photo->article_id = $article->id;

                $name=time() . '-' . $file->getClientOriginalName();
                $file->move(public_path().'/photos/', $name);

                $photo->path = $name;
                $photo->save();
            }
        }


        $notification = [
            'message' => 'You updated an article!',
            'alert-type' => 'success'
        ];

        return redirect('/admin/articles') ->with($notification);
    }
}
